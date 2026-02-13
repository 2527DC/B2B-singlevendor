<?php

namespace Modules\Driver\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Driver\Entities\Driver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SellerDriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::where('seller_id', Auth::id())->get();
        return view('driver::seller.index', compact('drivers'));
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
            'seller_id' => Auth::id(),
        ]);

        return redirect()->route('seller.drivers.index')->with('success', 'Driver created successfully.');
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::where('seller_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:drivers,phone,' . $id,
        ]);

        $driver->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('seller.drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy($id)
    {
        $driver = Driver::where('seller_id', Auth::id())->findOrFail($id);
        $driver->delete();

        return redirect()->route('seller.drivers.index')->with('success', 'Driver deleted successfully.');
    }

    public function resetPassword(Request $request, $id)
    {
        try {
            $request->validate([
                'new_password' => 'required|string|min:6|confirmed',
            ]);

            $driver = Driver::where('seller_id', Auth::id())->findOrFail($id);

            $driver->password = Hash::make($request->new_password);
            $driver->save();

            return redirect()
                ->route('seller.drivers.index')
                ->with('success', 'Password reset successfully.');

        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Failed to reset password.');
        }
    }
}