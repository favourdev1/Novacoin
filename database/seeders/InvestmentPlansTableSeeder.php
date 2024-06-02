<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvestmentPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'Plan 1',
                'description' => 'This is investment plan 1',
                'min_amount' => 100.00,
                'max_amount' => 1000.00,
                'daily_interest' => 1.00,
                'duration' => 30,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jombo Package',
                'description' => 'This is the jombo package',
                'min_amount' => 100.00,
                'max_amount' => 5000.00,
                'daily_interest' => 4.00,
                'duration' => 20,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($plans as $plan) {
            DB::table('investment_plans')->insert($plan);
        }

    }
}