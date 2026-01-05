<?php
namespace Modules\Driver\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Modules\Driver\Entities\Driver;

class DriverAuthController extends Controller
{
    /**
     * Login with phone + password
     */
/**
 * Login with phone + password
 */
public function login(Request $request)
{
    $request->validate([
        'phone' => 'required|string',
        'password' => 'required|string|min:6',
    ]);

    $driver = Driver::where('phone', $request->phone)->first();

    if (!$driver || !Hash::check($request->password, $driver->password)) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid phone or password',
        ], 401);
    }

    // ✅ ACTIVE / INACTIVE CHECK
    if ($driver->is_active != 1) {
        return response()->json([
            'status' => false,
            'message' => 'Your account is inactive. Please contact support.',
        ], 403);
    }

    // Remove old tokens (optional)
    $driver->tokens()->delete();

    $token = $driver->createToken('driver-api')->plainTextToken;

    return response()->json([
        'status' => true,
        'message' => 'Login successful',
        'token' => $token,
        'token_type' => 'bearer',
        'driver' => [
            'id' => $driver->id,
            'name' => $driver->name,
            'phone' => $driver->phone,
            'email' => $driver->email,
            'is_active' => $driver->is_active,
        ],
    ]);
}


    /**
     * Logout - revoke token
     */
    public function logout(Request $request)
    {
        // Get driver from request (authenticated by driver.auth middleware)
        // Since we're using custom middleware, we can get it from Auth
        $driver = Auth::guard('sanctum')->user();
        
        if (!$driver) {
            Log::channel('driver_auth')->error('Logout failed - No authenticated driver found');
            
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        // Get current token
        $token = $driver->currentAccessToken();
        
        if ($token) {
            // Log logout details
            Log::channel('driver_auth')->info('Driver logout', [
                'driver_id' => $driver->id,
                'phone' => $driver->phone,
                'token_id' => $token->id,
                'ip_address' => $request->ip(),
                'logout_timestamp' => now()->toDateTimeString(),
            ]);

            // Revoke current token
            $token->delete();
        } else {
            // Fallback: Delete all tokens
            $driver->tokens()->delete();
            
            Log::channel('driver_auth')->info('Driver logout - cleared all tokens', [
                'driver_id' => $driver->id,
                'phone' => $driver->phone,
                'ip_address' => $request->ip(),
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Logout successful',
        ]);
    }

    /**
     * Get authenticated driver profile
     */
    public function profile(Request $request)
    {
        // Get authenticated driver
        $driver = Auth::guard('sanctum')->user();
        
        if (!$driver) {
            return response()->json([
                'status' => false,
                'message' => 'Driver not found',
            ], 401);
        }

        // Log profile access
        Log::channel('driver_auth')->debug('Driver profile accessed', [
            'driver_id' => $driver->id,
            'phone' => $driver->phone,
            'ip_address' => $request->ip(),
            'access_timestamp' => now()->toDateTimeString(),
        ]);

        // Hide sensitive information
        $driverData = $driver->toArray();
        unset($driverData['password'], $driverData['remember_token'], $driverData['api_token']);

        return response()->json([
            'status' => true,
            'data' => $driverData,
        ]);
    }

    /**
     * Token validation endpoint
     */
    public function validateToken(Request $request)
    {
        // Get authenticated driver
        $driver = Auth::guard('sanctum')->user();
        
        if (!$driver) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid token',
            ], 401);
        }

        // Log token validation
        Log::channel('driver_auth')->debug('Token validation check', [
            'driver_id' => $driver->id,
            'phone' => $driver->phone,
            'check_timestamp' => now()->toDateTimeString(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Token is valid',
            'driver' => [
                'id' => $driver->id,
                'name' => $driver->name,
                'phone' => $driver->phone,
                'email' => $driver->email,
                'status' => $driver->status,
            ],
        ]);
    }

    /**
     * Refresh token
     */
    public function refreshToken(Request $request)
    {
        $driver = Auth::guard('sanctum')->user();
        
        if (!$driver) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        // Get current token
        $currentToken = $driver->currentAccessToken();
        
        // Create new token
        $newToken = $driver->createToken('driver-api')->plainTextToken;
        
        // Delete old token
        if ($currentToken) {
            $currentToken->delete();
        }

        Log::channel('driver_auth')->info('Token refreshed', [
            'driver_id' => $driver->id,
            'old_token_id' => $currentToken ? $currentToken->id : 'none',
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Token refreshed successfully',
            'token' => $newToken,
            'token_type' => 'bearer',
        ]);
    }
}