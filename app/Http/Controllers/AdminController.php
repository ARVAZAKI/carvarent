<?php

namespace App\Http\Controllers;

use App\Models\Usage;
use App\Models\Driver;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\Facades\Charts;

class AdminController extends Controller
{
    public function dashboard()
    {
        $usages = Usage::with('vehicle')
            ->selectRaw('vehicle_id, SUM(distance_traveled) as total_distance')
            ->groupBy('vehicle_id')
            ->get();

        $labels = $usages->map(function($usage) {
            return $usage->vehicle->vehicle_license;
        })->toArray();

        $distances = $usages->pluck('total_distance')->toArray();
        $fuels = array_map(function($distance) {
            return $distance / 10;
        }, $distances);

        // Membuat chart
        $chart = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Total Distance Traveled (KM)",
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                    'data' => $distances
                ],
                [
                    "label" => "Estimated Fuel Used (Liter)",
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1,
                    'data' => $fuels
                ]
            ])
            ->options([]);

        return view('admin.dashboard', compact('chart'));
    }

    public function driver(){
        $drivers = Driver::all();
        return view('admin.driver', compact('drivers'));
    }

    public function booking(){
        $pendingBooking = Booking::with(['vehicle','driver'])->where('status','pending')->orWhere('status','rejected')->get();
        $acceptedbooking = Booking::with('vehicle')->where('status','acc')->get();
        $expiredBooking = Booking::with(['vehicle','usage'])->where('status','expired')->get();
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

    public function returnBooking($id){
        $booking = Booking::findOrFail($id);
        return view('admin.return-booking', compact('booking'));
    }
    
}