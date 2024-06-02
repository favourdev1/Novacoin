<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Illuminate\Support\Facades\DB;

class WalletsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wallets = [
            [
                'wallet_name' => 'Bitcoin',
                'wallet_address' => '1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wallet_name' => 'Etherum',
                'wallet_address' => '0x7a9f3cd060ab180f36c17fe6bdf9974f577d77f2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wallet_name' => 'Ripple',
                'wallet_address' => 'rEb8TK3gBgk5auZkwc6sHnwrGVJH8DuaLh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('wallets')->insert($wallets);
    }
}