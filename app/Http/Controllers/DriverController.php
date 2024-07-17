<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function add(){
        return view('admin.add-driver');
    }

    public function store(Request $request){
    $request->validate([
        'name' => 'required|string|max:255',
        'license_number' => 'required',
        'status' => 'required|in:available,not available',
    ]);

    Driver::create([
        'name' => $request->name,
        'license_number' => $request->license_number,
        'status' => $request->status,
    ]);

    return redirect()->route('admin.driver');
    }

    public function delete($id){
        $driver = Driver::findOrFail($id);
        $driver->delete();

        return redirect()->back();
    }

}
