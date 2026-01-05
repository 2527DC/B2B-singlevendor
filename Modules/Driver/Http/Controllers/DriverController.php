<?php

namespace Modules\Driver\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Driver\Entities\Driver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DriverController extends Controller
{
    public function index()
    {
        // Get real drivers from database instead of static data
        $drivers = Driver::all();
        
        return view('driver::index', compact('drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:drivers,phone',
            'password' => 'required|string|min:6',
        ]);

        Driver::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_active' => $request->has('is_active') ? 1 : 0,
            // Add other fields if needed
        ]);

        return redirect()->route('drivers.index')->with('success', 'Driver created successfully.');
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:drivers,phone,' . $id,
        ]);

        $driver->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();

        return redirect()->route('drivers.index')->with('success', 'Driver deleted successfully.');
    }

    
    public function resetPassword(Request $request, $id)
    {
        // 1️⃣ Request reached controller
        Log::info('🔐 Reset password API hit', [
            'driver_id_param' => $id,
            'ip' => $request->ip(),
            'request_payload' => $request->except(['new_password', 'new_password_confirmation']),
        ]);
    
        try {
    
            // 2️⃣ Validation start
            Log::info('🟡 Validation started');
    
            $request->validate([
                'new_password' => 'required|string|min:6|confirmed',
            ]);
    
            // 3️⃣ Validation success
            Log::info('🟢 Validation passed');
    
            // 4️⃣ Fetch driver
            Log::info('🟡 Fetching driver from DB');
    
            $driver = Driver::findOrFail($id);
    
            // 5️⃣ Driver found
            Log::info('🟢 Driver found', [
                'driver_id' => $driver->id,
                'phone' => $driver->phone,
                'is_active' => $driver->is_active,
            ]);
    
            // 6️⃣ Password update start
            Log::info('🟡 Updating password');
    
            $driver->password = Hash::make($request->new_password);
            $driver->save();
    
            // 7️⃣ Password updated successfully
            Log::info('✅ Password updated successfully', [
                'driver_id' => $driver->id,
                'updated_at' => $driver->updated_at,
                'reset_by' => auth()->id() ?? 'system',
            ]);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
    
            // ❌ Validation failed
            Log::warning('❌ Validation failed', [
                'errors' => $e->errors(),
                'input_received' => $request->all(),
            ]);
    
            throw $e; // Laravel will redirect back automatically
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    
            // ❌ Driver not found
            Log::error('❌ Driver not found', [
                'driver_id_param' => $id,
            ]);
    
            abort(404);
    
        } catch (\Throwable $e) {
    
            // ❌ Any unexpected error
            Log::error('🔥 Unexpected error during password reset', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
    
            throw $e;
        }
    
        // 8️⃣ Final response
        Log::info('🎉 Reset password flow completed');
    
        return redirect()
            ->route('drivers.index')
            ->with('success', 'Password reset successfully.');
    }
    
    
}