<?php

namespace App\Http\Controllers;

use App\Models\Driver;
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
        return view('admin.vehicle');
    }
}
