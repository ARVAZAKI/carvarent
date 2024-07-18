<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'tenant_name',
        'vehicle_id',
        'driver_id',
        'admin_id',
        'level',
        'status',
        'start_date',
        'end_date'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
 
    public function approvers()
    {
        return $this->belongsToMany(User::class, 'approver_bookings', 'booking_id', 'approver_id');
    }

    
    public function usage()
    {
        return $this->hasOne(Usage::class, 'booking_id', 'id');
    }
}
