<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function add(){
        return view('admin.add-driver');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required',
            'status' => 'required|in:available,not available',
        ]);

        try {
            $driver = Driver::create([
                'name' => $request->name,
                'license_number' => $request->license_number,
                'status' => $request->status,
            ]);

            Log::info(Auth::user()->email . ' has created driver successfully.', ['driver_name' => $driver->name, 'driver_id' => $driver->id]);

            return redirect()->route('admin.driver');
        } catch (\Exception $e) {
            Log::error(Auth::user()->email . ' Failed to create driver.', ['error' => $e->getMessage()]);
        }
    }


    public function delete($id){
        try {
            $driver = Driver::findOrFail($id);
            $driver->delete();
            Log::info(Auth::user()->email .' has deleted driver successfully.', ['driver_name' => $driver->name, 'driver_id' => $driver->id]);
            return redirect()->route('admin.driver');
        } catch (\Exception $e) {
            Log::error(Auth::user()->email . ' Failed to delete driver.', ['error' => $e->getMessage()]);
        }
    }

}
