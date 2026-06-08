<?php

namespace Modules\GoogleWorkspace\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GoogleWorkspace\Entities\GoogleWorkspaceToken;
use Google\Service\Drive as GoogleDriveService;
use Google\Service\Drive\DriveFile as GoogleDriveFile;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;

class GoogleWorkspaceDriveController extends Controller
{
    private function getDriveService()
    {
        $token = GoogleWorkspaceToken::where('user_id', auth()->id())->first();
        if (!$token || !$token->access_token) {
            return null;
        }

        try {
            $client = $token->getClient();
            // Just check if client authenticated correctly
            if (!$client->getAccessToken()) {
                return null;
            }
            return new GoogleDriveService($client);
        } catch (\Exception $e) {
            Log::error('Failed to initialize Google Drive service: ' . $e->getMessage());
            return null;
        }
    }

    public function index()
    {
        $service = $this->getDriveService();
        if (!$service) {
            return view('googleworkspace::drive', ['connected' => false]);
        }

        try {
            $optParams = [
                'pageSize' => 100,
                'fields' => 'nextPageToken, files(id, name, mimeType, modifiedTime, size)',
                'q' => "trashed = false",
                'orderBy' => 'folder,name'
            ];
            $results = $service->files->listFiles($optParams);
            $files = $results->getFiles();

            return view('googleworkspace::drive', [
                'connected' => true,
                'files' => $files
            ]);
        } catch (\Exception $e) {
            Log::error('Google Drive list error: ' . $e->getMessage());
            // Check if it's an authentication error
            if (strpos($e->getMessage(), '401') !== false || strpos($e->getMessage(), 'auth') !== false) {
                Toastr::error(trans('google_workspace.connection_required'));
                return view('googleworkspace::drive', ['connected' => false]);
            }
            Toastr::error('Unable to fetch Google Drive files.');
            return view('googleworkspace::drive', ['connected' => true, 'files' => []]);
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:file,folder',
            'content' => 'nullable|string'
        ]);

        $service = $this->getDriveService();
        if (!$service) {
            Toastr::error(trans('google_workspace.connection_required'));
            return redirect()->back();
        }

        try {
            if ($request->type === 'folder') {
                $fileMetadata = new GoogleDriveFile([
                    'name' => $request->name,
                    'mimeType' => 'application/vnd.google-apps.folder',
                ]);
                $file = $service->files->create($fileMetadata, ['fields' => 'id']);
                Toastr::success('Folder created successfully.');
            } else {
                $fileMetadata = new GoogleDriveFile([
                    'name' => $request->name,
                    'mimeType' => 'text/plain',
                ]);
                $content = $request->content ?? '';
                $file = $service->files->create($fileMetadata, [
                    'data' => $content,
                    'mimeType' => 'text/plain',
                    'uploadType' => 'multipart',
                    'fields' => 'id',
                ]);
                Toastr::success('File created successfully.');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Google Drive create file/folder exception: ' . $e->getMessage());
            Toastr::error('Failed to create item in Google Drive.');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $service = $this->getDriveService();
        if (!$service) {
            Toastr::error(trans('google_workspace.connection_required'));
            return redirect()->back();
        }

        try {
            $service->files->delete($id);
            Toastr::success('Item deleted successfully from Google Drive.');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Google Drive delete exception: ' . $e->getMessage());
            Toastr::error('Failed to delete item from Google Drive.');
            return redirect()->back();
        }
    }
}
