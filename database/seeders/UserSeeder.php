<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Endang Purwati',
            'email' => 'endangpurwati@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'bidan',
        ]);
        User::create([
            'name' => 'Desi',
            'email' => 'desi@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'asisten',
        ]);
    }
}