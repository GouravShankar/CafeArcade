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
            "fullname" => "Manshi Kumari",
            "username" => "Manshi",
            "email" => "manshik3083@gmail.com",
            "password" => Hash::make("1234"),
            "image" => env("IMAGE_PROFILE"),
            "phone" => "6299523642",
            "gender" => "F",
            "address" => "Mahavir Mandir Sonouli Chowk Purnia",
            "role_id" => 1,
            "coupon" => 0,
            "point" => 0,
            'remember_token' => Str::random(30),
        ]);

        User::create([
            "fullname" => "Gourav Shankar",
            "username" => "Gourav",
            "email" => "gouravshankar51@gmail.com",
            "password" => Hash::make("Kumar@123"),
            "image" => env("IMAGE_PROFILE"),
            "phone" => "9693872552",
            "gender" => "M",
            "address" => "Phagwara Punjab",
            "role_id" => 2,
            "coupon" => 0,
            "point" => 0,
            'remember_token' => Str::random(30),
        ]);

        

       
    }
}
