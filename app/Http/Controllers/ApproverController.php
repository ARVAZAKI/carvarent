<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApproverController extends Controller
{
    public function dashboard()
{
    $bookings = Booking::with(['admin', 'vehicle', 'driver', 'approvers'])->where('status','pending')
        ->whereHas('approvers', function ($query) {
            $query->where('approver_id', Auth::user()->id)->where('status', 'pending');
        })
        ->get();

    return view('approver.dashboard', compact('bookings'));
}
}
