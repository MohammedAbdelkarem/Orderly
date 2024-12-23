<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'first_name' => 'customer',
            'last_name' => 'customer',
            'phone' => '12345678',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('password'),
            'address_name' => 'belfort street',
            'lat' => '494949',
            'lng' => '400300303',
        ]);
    }
}
