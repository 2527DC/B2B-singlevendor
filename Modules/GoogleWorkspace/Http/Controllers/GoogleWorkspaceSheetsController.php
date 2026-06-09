<?php

namespace Modules\GoogleWorkspace\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GoogleWorkspace\Entities\GoogleWorkspaceToken;
use Google\Service\Drive as GoogleDriveService;
use Google\Service\Sheets as GoogleSheetsService;
use Google\Service\Sheets\Spreadsheet as GoogleSpreadsheet;
use Google\Service\Sheets\ValueRange as GoogleValueRange;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;

class GoogleWorkspaceSheetsController extends Controller
{
    private function getServices()
    {
        $token = GoogleWorkspaceToken::where('user_id', auth()->id())->first();
        if (!$token || !$token->access_token) {
            return null;
        }

        try {
            $client = $token->getClient();
            if (!$client->getAccessToken()) {
                return null;
            }
            return [
                'drive' => new GoogleDriveService($client),
                'sheets' => new GoogleSheetsService($client)
            ];
        } catch (\Exception $e) {
            Log::error('Failed to initialize Google Sheets services: ' . $e->getMessage());
            return null;
        }
    }

    public function index()
    {
        $services = $this->getServices();
        if (!$services) {
            return view('googleworkspace::sheets', ['connected' => false]);
        }

        try {
            $optParams = [
                'pageSize' => 100,
                'fields' => 'nextPageToken, files(id, name, modifiedTime)',
                'q' => "mimeType = 'application/vnd.google-apps.spreadsheet' and trashed = false",
                'orderBy' => 'name'
            ];
            $results = $services['drive']->files->listFiles($optParams);
            $spreadsheets = $results->getFiles();

            return view('googleworkspace::sheets', [
                'connected' => true,
                'spreadsheets' => $spreadsheets
            ]);
        } catch (\Exception $e) {
            Log::error('Google Sheets list error: ' . $e->getMessage());
            if (strpos($e->getMessage(), '401') !== false || strpos($e->getMessage(), 'auth') !== false) {
                Toastr::error(trans('google_workspace.connection_required'));
                return view('googleworkspace::sheets', ['connected' => false]);
            }
            Toastr::error('Unable to fetch spreadsheets.');
            return view('googleworkspace::sheets', ['connected' => true, 'spreadsheets' => []]);
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $services = $this->getServices();
        if (!$services) {
            Toastr::error(trans('google_workspace.connection_required'));
            return redirect()->back();
        }

        try {
            $spreadsheet = new GoogleSpreadsheet([
                'properties' => [
                    'title' => $request->title
                ]
            ]);
            $newSpreadsheet = $services['sheets']->spreadsheets->create($spreadsheet);

            Toastr::success('Spreadsheet created successfully.');
            return redirect()->route('google-workspace.sheets.view', $newSpreadsheet->spreadsheetId);
        } catch (\Exception $e) {
            Log::error('Google Sheets create exception: ' . $e->getMessage());
            Toastr::error('Failed to create spreadsheet.');
            return redirect()->back();
        }
    }

    public function view($id, Request $request)
    {
        $services = $this->getServices();
        if (!$services) {
            Toastr::error(trans('google_workspace.connection_required'));
            return redirect()->route('google-workspace.sheets');
        }

        try {
            // Get Spreadsheet structure to get sheets/tabs
            $spreadsheet = $services['sheets']->spreadsheets->get($id);
            $worksheets = [];
            foreach ($spreadsheet->getSheets() as $sheet) {
                $worksheets[] = $sheet->getProperties()->getTitle();
            }

            // Determine active worksheet (default to first one)
            $activeSheet = $request->query('sheet', $worksheets[0] ?? 'Sheet1');

            // Fetch worksheet values
            $range = $activeSheet . '!A1:Z100'; // fetch first 100 rows, columns A to Z
            $response = $services['sheets']->spreadsheets_values->get($id, $range);
            $rows = $response->getValues() ?? [];

            return view('googleworkspace::sheet_view', [
                'connected' => true,
                'spreadsheetId' => $id,
                'spreadsheetTitle' => $spreadsheet->getProperties()->getTitle(),
                'worksheets' => $worksheets,
                'activeSheet' => $activeSheet,
                'rows' => $rows
            ]);
        } catch (\Exception $e) {
            Log::error('Google Sheets view exception: ' . $e->getMessage());
            Toastr::error('Failed to load spreadsheet content.');
            return redirect()->route('google-workspace.sheets');
        }
    }

    public function appendRow($id, Request $request)
    {
        $request->validate([
            'sheet_name' => 'required|string',
            'row_data' => 'required|string'
        ]);

        $services = $this->getServices();
        if (!$services) {
            Toastr::error(trans('google_workspace.connection_required'));
            return redirect()->back();
        }

        try {
            // Parse row data
            $input = trim($request->row_data);
            
            // Check if it's a valid JSON array
            $decoded = json_decode($input, true);
            if (is_array($decoded)) {
                $rowValues = array_values($decoded);
            } else {
                // Parse as CSV comma-separated
                $rowValues = str_getcsv($input);
            }

            $body = new GoogleValueRange([
                'values' => [$rowValues]
            ]);
            $params = [
                'valueInputOption' => 'USER_ENTERED'
            ];
            
            $range = $request->sheet_name . '!A1'; // Google sheets automatically appends to the end of sheet starting at range
            $services['sheets']->spreadsheets_values->append($id, $range, $body, $params);

            Toastr::success('Row appended successfully.');
            return redirect()->route('google-workspace.sheets.view', [
                'id' => $id,
                'sheet' => $request->sheet_name
            ]);
        } catch (\Exception $e) {
            Log::error('Google Sheets append row exception: ' . $e->getMessage());
            Toastr::error('Failed to append row to spreadsheet.');
            return redirect()->back();
        }
    }

    public function exportTableData(Request $request)
    {
        $request->validate([
            'file_name' => 'required|string',
            'headers' => 'required|array',
            'rows' => 'nullable|array'
        ]);

        $token = GoogleWorkspaceToken::where('user_id', auth()->id())->first();
        if (!$token || !$token->client_id || !$token->client_secret) {
            return response()->json([
                'success' => false,
                'message' => 'Google Workspace integration is not connected. Please connect it in Google Workspace Settings.'
            ], 400);
        }

        try {
            $client = $token->getClient();
            if (!$client->getAccessToken()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Google Workspace account is not authenticated.'
                ], 400);
            }
            $sheetsService = new GoogleSheetsService($client);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to initialize Google Sheets service: ' . $e->getMessage()
            ], 500);
        }

        $sanitizeValue = function ($val) {
            return is_null($val) ? '' : $val;
        };

        $headers = array_map($sanitizeValue, array_values($request->input('headers', [])));
        $bodyRows = [];
        if ($request->has('rows') && is_array($request->input('rows'))) {
            foreach ($request->input('rows') as $row) {
                if (is_array($row)) {
                    $bodyRows[] = array_map($sanitizeValue, array_values($row));
                }
            }
        }
        $allRows = array_merge([$headers], $bodyRows);

        $fileName = $request->file_name . '_' . date('Y-m-d_H-i-s');

        try {
            $spreadsheet = new GoogleSpreadsheet([
                'properties' => [
                    'title' => $fileName
                ]
            ]);
            $newSpreadsheet = $sheetsService->spreadsheets->create($spreadsheet);
            $spreadsheetId = $newSpreadsheet->spreadsheetId;

            Log::info('Google Sheets export allRows: ' . json_encode($allRows));
            $body = new GoogleValueRange([
                'values' => $allRows
            ]);
            $params = [
                'valueInputOption' => 'USER_ENTERED'
            ];
            $sheetsService->spreadsheets_values->append($spreadsheetId, 'Sheet1!A1', $body, $params);

            $spreadsheetUrl = 'https://docs.google.com/spreadsheets/d/' . $spreadsheetId . '/edit';

            return response()->json([
                'success' => true,
                'file_name' => $fileName,
                'spreadsheet_url' => $spreadsheetUrl
            ]);
        } catch (\Exception $e) {
            Log::error('Google Sheets generic export exception: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create and write to spreadsheet: ' . $e->getMessage()
            ], 500);
        }
    }
}
