<?php

namespace Modules\GoogleWorkspace\Entities;

use Illuminate\Database\Eloquent\Model;
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDriveService;
use Google\Service\Sheets as GoogleSheetsService;
use Illuminate\Support\Facades\Log;

class GoogleWorkspaceToken extends Model
{
    protected $table = 'google_workspace_tokens';
    protected $fillable = [
        'user_id',
        'client_id',
        'client_secret',
        'access_token',
        'refresh_token',
        'token_type',
        'expires_at'
    ];

    /**
     * Check if the access token is expired or close to expiring.
     */
    public function isExpired()
    {
        if (!$this->expires_at) {
            return true;
        }
        // If expired or expiring within 60 seconds
        return time() >= ($this->expires_at - 60);
    }

    /**
     * Get an authenticated Google Client.
     */
    public function getClient()
    {
        $client = new GoogleClient();
        $client->setClientId($this->client_id);
        $client->setClientSecret($this->client_secret);
        $client->setRedirectUri(route('google-workspace.oauth-callback'));
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        $client->addScope([
            GoogleDriveService::DRIVE,
            GoogleSheetsService::SPREADSHEETS
        ]);

        if ($this->access_token) {
            $client->setAccessToken([
                'access_token' => $this->access_token,
                'refresh_token' => $this->refresh_token,
                'token_type' => $this->token_type ?? 'Bearer',
                'created' => $this->updated_at->timestamp,
                'expires_in' => max(0, $this->expires_at - time())
            ]);

            // Automatically refresh the token if it has expired
            if ($this->isExpired()) {
                if ($this->refresh_token) {
                    try {
                        $new_token = $client->fetchAccessTokenWithRefreshToken($this->refresh_token);
                        if (isset($new_token['access_token'])) {
                            $this->update([
                                'access_token' => $new_token['access_token'],
                                'expires_at' => time() + ($new_token['expires_in'] ?? 3600),
                                'refresh_token' => $new_token['refresh_token'] ?? $this->refresh_token
                            ]);
                            $client->setAccessToken($new_token);
                        } else {
                            Log::error('Failed to refresh Google token: ' . json_encode($new_token));
                        }
                    } catch (\Exception $e) {
                        Log::error('Google OAuth refresh exception: ' . $e->getMessage());
                    }
                } else {
                    Log::warning('Google access token is expired and no refresh token is available.');
                }
            }
        }

        return $client;
    }
}
