<?php

namespace Database\Seeders;

use App\Models\User;
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
     
    }
}
