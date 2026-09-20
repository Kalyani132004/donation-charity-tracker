<?php

namespace Database\Seeders;

use App\Models\Cause;
use Illuminate\Database\Seeder;

class CauseSeeder extends Seeder
{
    public function run(): void
    {
        $causes = [
            ['name' => 'Education Support', 'description' => 'Funding school fees, books and supplies for underprivileged children.', 'target_amount' => 500000],
            ['name' => 'Medical Support', 'description' => 'Covering treatment and medicine costs for patients in need.', 'target_amount' => 750000],
            ['name' => 'Food Distribution', 'description' => 'Providing daily meals to families facing food insecurity.', 'target_amount' => 300000],
        ];

        foreach ($causes as $cause) {
            Cause::create([
                'name' => $cause['name'],
                'description' => $cause['description'],
                'target_amount' => $cause['target_amount'],
                'status' => 'active',
            ]);
        }
    }
}