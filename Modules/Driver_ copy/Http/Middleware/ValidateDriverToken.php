<?php

namespace Modules\Driver\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\Driver\Entities\Driver;

class ValidateDriverToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Log token validation attempt
        Log::channel('driver_auth')->debug('Driver token validation started', [
            'endpoint' => $request->path(),
            'ip' => $request->ip(),
            'method' => $request->method(),
            'timestamp' => now()->toDateTimeString(),
        ]);

        // Check if user is authenticated via Sanctum
        if (!Auth::guard('sanctum')->check()) {
            $token = $request->bearerToken();
            
            Log::channel('driver_auth')->warning('Driver authentication failed', [
                'reason' => $token ? 'Invalid token' : 'No token provided',
                'token_preview' => $token ? substr($token, 0, 20) . '...' : 'none',
                'ip' => $request->ip(),
                'endpoint' => $request->path(),
                'user_agent' => $request->userAgent(),
                'timestamp' => now()->toDateTimeString(),
            ]);
            
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized. Please provide a valid authentication token.',
                'code' => 'UNAUTHENTICATED',
            ], 401);
        }

        // Get authenticated user
        $user = Auth::guard('sanctum')->user();
        
        // Verify it's a Driver instance
        if (!$user instanceof Driver) {
            Log::channel('driver_auth')->error('Authenticated user is not a Driver instance', [
                'user_id' => $user->id,
                'user_type' => get_class($user),
                'expected_type' => Driver::class,
                'endpoint' => $request->path(),
                'timestamp' => now()->toDateTimeString(),
            ]);
            
            return response()->json([
                'status' => false,
                'message' => 'Access denied. Invalid user type.',
                'code' => 'INVALID_USER_TYPE',
            ], 403);
        }

        // Check driver status
        if (isset($user->status) && $user->status !== 'active') {
            Log::channel('driver_auth')->warning('Driver account not active', [
                'driver_id' => $user->id,
                'phone' => $user->phone,
                'status' => $user->status,
                'endpoint' => $request->path(),
                'timestamp' => now()->toDateTimeString(),
            ]);
            
            return response()->json([
                'status' => false,
                'message' => 'Your account is not active. Please contact support.',
                'code' => 'ACCOUNT_INACTIVE',
            ], 403);
        }

        // Log successful authentication
        Log::channel('driver_auth')->debug('Driver authenticated successfully', [
            'driver_id' => $user->id,
            'phone' => $user->phone,
            'endpoint' => $request->path(),
            'timestamp' => now()->toDateTimeString(),
        ]);

        return $next($request);
    }
}