<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FundAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fund_accounts')->insert([
            'wallet_id' => 1, // Assuming a wallet with id 1 exists
            'user_id' => 1, // Assuming a user with id 1 exists
            'amount' => 100.00,
            'payment_proof' => Str::random(10),
            'status' => 'pending',
            'approved_by' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}