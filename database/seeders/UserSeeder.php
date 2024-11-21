<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "fullname" => "Aditya vishwakarma",
            "username" => "Aditya",
            "email" => "aditya123@gmail.com",
            "password" => Hash::make("123"),
            "image" => env("IMAGE_PROFILE"),
            "phone" => "8707610243",
            "gender" => "M",
            "address" => "Shell road number 10",
            "role_id" => 1,
            "coupon" => 0,
            "point" => 0,
            'remember_token' => Str::random(30),
        ]);

        User::create([
            "fullname" => "Manshi",
            "username" => "Manshi",
            "email" => "manshi123@gmail.com",
            "password" => Hash::make("1234"),
            "image" => env("IMAGE_PROFILE"),
            "phone" => "082918391823",
            "gender" => "M",
            "address" => "Shell road number 18",
            "role_id" => 2,
            "coupon" => 0,
            "point" => 0,
            'remember_token' => Str::random(30),
        ]);

        

       
    }
}
