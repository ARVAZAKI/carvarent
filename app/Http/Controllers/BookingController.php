<?php

namespace App\Http\Controllers;

use App\Exports\ExportBooking;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Usage;
use App\Models\Driver;
use App\Models\Booking;
use App\Models\Vehicle;
use Ramsey\Uuid\Type\Time;
use Illuminate\Http\Request;
use App\Models\ApproverBooking;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Exp;

class BookingController extends Controller
{
    public function add (){
        $vehicles = Vehicle::where('status','available')->get();
        $drivers = Driver::where('status','available')->get();
        $approvers = User::where('role','approver')->get();
        return view('admin.add-booking', compact('vehicles','drivers','approvers'));
    }

    public function store(Request $request){
        $validate = $request->validate([
            'tenant_name' => 'required|string|max:255',
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'start_date' => 'required|',
            'end_date' => 'required|',
        ]);

        $booking = Booking::create([
            'tenant_name' => $request->tenant_name,
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'admin_id' => Auth::user()->id,
            'level' => 0,
            'status' => 'pending',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);
        ApproverBooking::create([
            'booking_id' => $booking->id,
            'approver_id' => $request->approver_1,
            'status' => 'pending'
        ]);
        ApproverBooking::create([
            'booking_id' => $booking->id,
            'approver_id' => $request->approver_2,
            'status' => 'pending'
        ]);
       
        return redirect()->route('admin.booking');

    }

    public function cancel($id){
        try {
            $booking = booking::findOrFail($id);
            $booking->delete();
            Log::info(Auth::user()->email .' has canceled booking successfully.', ['booking_id' => $booking->id]);
            return redirect()->route('admin.booking');
        } catch (\Exception $e) {
            Log::error(Auth::user()->email . ' Failed to cancel booking.', ['error' => $e->getMessage()]);
        }
    }

    public function detail($id){
    $booking = Booking::with(['admin', 'vehicle', 'driver'])->findOrFail($id);
    return view('approver.detail-booking', compact('booking'));
    }

    public function acc($id){
        $booking = Booking::findOrFail($id);
        $booking->level += 1;
        $booking->save();
        
        ApproverBooking::where('booking_id', $booking->id)->where('approver_id', Auth::user()->id )->update([
            'status' => 'acc'
        ]);
        
        if($booking->level == 2){
            $booking->status = 'acc';
            $booking->accepted_date = Carbon::now();
            $booking->save(); 
            
            Driver::where('id', $booking->driver_id)->update([
                'status' => 'not available'
            ]);
    
            Vehicle::where('id', $booking->vehicle_id)->update([
                'status' => 'not available'
            ]);
        }
    
        return redirect()->route('approver.dashboard');
    }
    

    public function reject($id){
        $booking = Booking::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();

        ApproverBooking::where('booking_id', $booking->id)->where('approver_id', Auth::user()->id )->update([
            'status' => 'rejected'
        ]);

        return redirect()->route('approver.dashboard');
    }

    public function returnBooking(Request $request, $id)
    {
        $request->validate([
            'distance_traveled' => 'required|numeric',
            'return_date' => 'required|date',
        ]);

        $booking = Booking::with(['vehicle', 'driver'])->findOrFail($id);

        $booking->status = 'expired';
        $booking->save();

        Usage::create([
            'booking_id' => $booking->id,
            'vehicle_id' => $booking->vehicle->id,
            'distance_traveled' => $request->distance_traveled,
            'return_date' => $request->return_date,
            'input_by' => Auth::user()->id
        ]);

        Vehicle::where('id', $booking->vehicle->id)->update([
            'status' => 'available'
        ]);

        Driver::where('id', $booking->driver->id)->update([
            'status' => 'available'
        ]);

        return redirect()->route('admin.booking')->with('success', 'Booking returned successfully');
    }


    public function showdetail($id){
        $booking = Booking::with(['vehicle','admin','approvers','usage','driver'])->find($id);
        if ($booking) {
            $vehicle = $booking->vehicle;
            $admin = $booking->admin;
            $approvers = $booking->approvers;
            $usage = $booking->usage;
            $driver = $booking->driver;
        }
        return view('admin.detail-booking', compact('booking','vehicle','admin','approvers','usage','driver'));
    }

    public function export_excel()
    {
        return Excel::download(new ExportBooking, 'bookings_report.xlsx');
    }
    


}
