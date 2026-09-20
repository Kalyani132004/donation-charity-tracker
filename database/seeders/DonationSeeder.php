<?php

namespace Database\Seeders;

use App\Models\Cause;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\User;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    public function run(): void
    {
        $donorIds = Donor::pluck('id')->all();
        $causeIds = Cause::pluck('id')->all();
        $adminId = User::where('role', 'admin')->value('id');
        $staffId = User::where('role', 'staff')->value('id');

        $modes = Donation::DONATION_MODES;
        $categories = Donation::FINANCIAL_CATEGORIES;

        for ($i = 0; $i < 8; $i++) {
            $date = now()->subDays(rand(0, 90))->toDateString();

            Donation::create([
                'receipt_number' => Donation::generateReceiptNumber(),
                'donor_id' => $donorIds[array_rand($donorIds)],
                'cause_id' => $causeIds[array_rand($causeIds)],
                'amount' => rand(500, 20000),
                'donation_mode' => $modes[array_rand($modes)],
                'donation_date' => $date,
                'financial_category' => $categories[array_rand($categories)],
                'notes' => null,
                'created_by' => rand(0, 1) ? $adminId : $staffId,
            ]);
        }
    }
}