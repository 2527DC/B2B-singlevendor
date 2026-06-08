<?php

namespace Modules\GoogleWorkspace\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GoogleWorkspace\Entities\GoogleWorkspaceToken;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;

class GoogleWorkspaceSettingsController extends Controller
{
    public function index()
    {
        $token = GoogleWorkspaceToken::where('user_id', auth()->id())->first();
        return view('googleworkspace::settings', compact('token'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'client_id' => 'required|string',
            'client_secret' => 'required|string',
        ]);

        try {
            GoogleWorkspaceToken::updateOrCreate(
                ['user_id' => auth()->id()],
                [
                    'client_id' => $request->client_id,
                    'client_secret' => $request->client_secret,
                ]
            );

            Toastr::success(trans('google_workspace.save_success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Error saving Google Workspace settings: ' . $e->getMessage());
            Toastr::error(trans('common.error_message'));
            return redirect()->back();
        }
    }

    public function connect()
    {
        $token = GoogleWorkspaceToken::where('user_id', auth()->id())->first();

        if (!$token || !$token->client_id || !$token->client_secret) {
            Toastr::error(trans('google_workspace.invalid_credentials'));
            return redirect()->back();
        }

        try {
            $client = $token->getClient();
            $authUrl = $client->createAuthUrl();
            return redirect()->away($authUrl);
        } catch (\Exception $e) {
            Log::error('Error initiating Google OAuth: ' . $e->getMessage());
            Toastr::error(trans('common.error_message'));
            return redirect()->back();
        }
    }

    public function callback(Request $request)
    {
        if (!$request->has('code')) {
            Toastr::error('Authorization code not returned from Google.');
            return redirect()->route('google-workspace.settings');
        }

        try {
            $token = GoogleWorkspaceToken::where('user_id', auth()->id())->first();
            if (!$token) {
                Toastr::error(trans('google_workspace.invalid_credentials'));
                return redirect()->route('google-workspace.settings');
            }

            $client = $token->getClient();
            $accessToken = $client->fetchAccessTokenWithAuthCode($request->code);

            if (isset($accessToken['error'])) {
                Log::error('Google OAuth callback error: ' . json_encode($accessToken));
                Toastr::error('Failed to authenticate with Google: ' . ($accessToken['error_description'] ?? $accessToken['error']));
                return redirect()->route('google-workspace.settings');
            }

            $token->update([
                'access_token' => $accessToken['access_token'],
                'refresh_token' => $accessToken['refresh_token'] ?? $token->refresh_token,
                'token_type' => $accessToken['token_type'] ?? 'Bearer',
                'expires_at' => time() + ($accessToken['expires_in'] ?? 3600),
            ]);

            Toastr::success(trans('google_workspace.connect_success'));
            return redirect()->route('google-workspace.settings');
        } catch (\Exception $e) {
            Log::error('Google OAuth callback exception: ' . $e->getMessage());
            Toastr::error(trans('common.error_message'));
            return redirect()->route('google-workspace.settings');
        }
    }

    public function disconnect()
    {
        try {
            $token = GoogleWorkspaceToken::where('user_id', auth()->id())->first();
            if ($token) {
                $token->update([
                    'access_token' => null,
                    'refresh_token' => null,
                    'expires_at' => null,
                ]);
            }

            Toastr::success(trans('google_workspace.disconnect_success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Error disconnecting Google account: ' . $e->getMessage());
            Toastr::error(trans('common.error_message'));
            return redirect()->back();
        }
    }
}
