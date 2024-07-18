<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'booking_id','vehicle_id','distance_traveled','return_date','input_by'
    ];

   
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'input_by', 'id');
    }
}
