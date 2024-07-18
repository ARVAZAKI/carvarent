<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Booking;
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
        $pendingBooking = Booking::with(['vehicle','driver'])->where('status','pending')->orWhere('status','rejected')->get();
        $acceptedbooking = Booking::with('vehicle')->where('status','acc')->get();
        $expiredBooking = Booking::with('vehicle')->where('status','expired')->get();
        return view('admin.booking', compact('pendingBooking', 'acceptedbooking', 'expiredBooking'));
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
