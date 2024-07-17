<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function driver(){
        return view('admin.driver');
    }

    public function booking(){
        return view('admin.booking');
    }

    public function vehicle(){
        return view('admin.vehicle');
    }
}
