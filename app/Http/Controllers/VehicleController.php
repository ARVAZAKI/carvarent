<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function add(){
        return view('admin.add-vehicle');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'vehicle_llicense' => 'required',
            'status' => 'required|in:available,not available,maintenance',
            'image' => 'required|mimes:jpg,png,jpeg'
        ]);
        try{
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->name . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('vehicle',$newName);
    
            $vehicle = Vehicle::create([
                'name' => $request->name,
                'type' => $request->type,
                'vehicle_license' => $request->vehicle_llicense,
                'status' => $request->status,
                'image' => $newName
            ]);
            
            Log::info(Auth::user()->email . ' has created vehicle successfully.', ['vehicle_name' => $vehicle->name, 'vehicle_id' => $vehicle->id]);
            return redirect()->route('admin.vehicle');
        }catch(\Exception $e){
            Log::error(Auth::user()->email . ' Failed to create vehicle.', ['error' => $e->getMessage()]);
        }
    }

    public function delete($id){
        try{
            $vehicle = Vehicle::findOrFail($id);
            $vehicle->delete();
            Log::info(Auth::user()->email . ' has deleted vehicle successfully', ['vehicle_name' => $vehicle->name, 'vehicle_id' => $vehicle->id]);
            return redirect()->back();
        }catch(\Exception $e){
            Log::error(Auth::user()->email . ' Failed to delete vehicle', ['error' => $e->getMessage()]);
        }
    }

}
