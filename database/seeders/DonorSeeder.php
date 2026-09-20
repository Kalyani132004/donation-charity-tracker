<?php

namespace Database\Seeders;

use App\Models\Donor;
use Illuminate\Database\Seeder;

class DonorSeeder extends Seeder
{
    public function run(): void
    {
        $donors = [
            ['name' => 'Rahul Sharma', 'email' => 'rahul.sharma@example.com', 'phone' => '9876543210', 'city' => 'Pune', 'state' => 'Maharashtra'],
            ['name' => 'Priya Patel', 'email' => 'priya.patel@example.com', 'phone' => '9876543211', 'city' => 'Ahmedabad', 'state' => 'Gujarat'],
            ['name' => 'Amit Kumar', 'email' => 'amit.kumar@example.com', 'phone' => '9876543212', 'city' => 'Delhi', 'state' => 'Delhi'],
            ['name' => 'Sneha Reddy', 'email' => 'sneha.reddy@example.com', 'phone' => '9876543213', 'city' => 'Hyderabad', 'state' => 'Telangana'],
            ['name' => 'Vikram Singh', 'email' => 'vikram.singh@example.com', 'phone' => '9876543214', 'city' => 'Jaipur', 'state' => 'Rajasthan'],
        ];

        foreach ($donors as $donor) {
            Donor::create([
                'donor_code' => Donor::generateDonorCode(),
                'name' => $donor['name'],
                'email' => $donor['email'],
                'phone' => $donor['phone'],
                'address' => '',
                'city' => $donor['city'],
                'state' => $donor['state'],
            ]);
        }
    }
}