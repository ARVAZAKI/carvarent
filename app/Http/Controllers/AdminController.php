<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function driver(){
        $drivers = Driver::all();
        return view('admin.driver', compact('drivers'));
    }

    public function booking(){
        return view('admin.booking');
    }

    public function vehicle(){
        $vehicles = Vehicle::all();
        return view('admin.vehicle', compact('vehicles'));
    }

    public function searchVehicle(Request $request){
        $vehicles = Vehicle::where('name', 'LIKE', '%' . $request->search . '%')->get();
        return view('admin.vehicle', compact('vehicles'));
    }
}
