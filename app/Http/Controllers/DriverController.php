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
        Driver::create([
            'name' => $request->name,
            'licence_number' => $request->licence_number,
            'status' => $request->status
        ]);
        return redirect()->route('admin.driver');
    }
}
