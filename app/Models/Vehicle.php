<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'image',
        'name',
        'type',
        'vehicle_license',
        'status'
    ];

    public function booking()
    {
        return $this->hasMany(Booking::class, 'vehicle_id', 'id');
    }
}
