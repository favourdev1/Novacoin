<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class WalletCurrenySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wallets = [
            [
                'name' => 'Bitcoin',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Usdt',

                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        DB::table('withdrawal_currencies')->insert($wallets);
    }
}