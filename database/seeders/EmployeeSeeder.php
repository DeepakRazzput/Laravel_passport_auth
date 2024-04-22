<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class EmployeeSeeder extends Seeder
{
   
    public function run()
    {
        $indianNames = [
            'Aarav', 'Aarohi', 'Abhinav', 'Aditi', 'Advik', 'Alisha', 'Amit', 'Ananya', 'Aniket', 'Ananya', 
            'Arnav', 'Ashima', 'Ayaan', 'Bhavna', 'Chirag', 'Dhriti', 'Divya', 'Eshaan', 'Isha', 'Ishan', 
            'Ishika', 'Jai', 'Jiya', 'Kabir', 'Kavya', 'Krish', 'Lakshya', 'Mehak', 'Mihika', 'Neha', 
            'Nikita', 'Nirav', 'Palak', 'Parth', 'Priya', 'Rahul', 'Riya', 'Rohan', 'Saachi', 'Saanvi', 
            'Sahil', 'Sanya', 'Shreya', 'Tanvi', 'Tara', 'Vedant', 'Vidhi', 'Vivaan', 'Yash', 'Zoya'
        ];

        $employees = [];

        for ($i = 0; $i < 50; $i++) {
            $name = $indianNames[$i % count($indianNames)]; // Loop through Indian names
            $email = strtolower(str_replace(' ', '', $name)) . '@example.com'; // Example email format
            $employees[] = ['name' => $name, 'email' => $email];
        }

        // Now insert the generated employees into the database using DB facade
        DB::table('employees')->insert($employees);
    }
    }


