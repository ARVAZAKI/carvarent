<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('wkwk'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'arva approver',
            'email' => 'arva@approver.com',
            'password' => Hash::make('wkwk'),
            'role' => 'approver'
        ]);
        User::create([
            'name' => 'zaki approver',
            'email' => 'zaki@approver.com',
            'password' => Hash::make('wkwk'),
            'role' => 'approver'
        ]);
        Driver::create([
            'name' => 'joko',
            'license_number' => '42342243'
        ]);
        Driver::create([
            'name' => 'Budi',
            'license_number' => '12312312'
        ]);
        Driver::create([
            'name' => 'Bambang',
            'license_number' => '9834117'
        ]);
        Vehicle::create([
            'name' => 'toyota avanza',
            'type' => 'HRV',
            'vehicle_license' => 'L 4043 MK',
            'status' => 'available',
            'image' => 'toyota avanza1721346866.jpeg'
        ]);
        Vehicle::create([
            'name' => 'truk semen',
            'type' => 'truk',
            'vehicle_license' => 'L 7238 PP',
            'status' => 'available',
            'image' => 'truk semen1721346903.jpeg'
        ]);
     
    }
}
