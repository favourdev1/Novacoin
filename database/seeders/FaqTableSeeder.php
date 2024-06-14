<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('faqs')->insert([
            [
                'category' => 'Investment Basics',
                'question' => 'What is an investment?',
                'answer' => 'Investment is the process of putting your money to work to start or expand a project - or to purchase an asset or interest - where those funds are put at risk in the hopes of generating a return.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Investment Risks',
                'question' => 'What are the risks of investing?',
                'answer' => 'Investing always involves risks, including the possibility of losing the money you invest. Some investments have more risk than others. The higher the potential return, the higher the risk.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Investment Strategies',
                'question' => 'What are some common investment strategies?',
                'answer' => 'Some common strategies include growth investing, value investing, income investing, and dollar-cost averaging. The right strategy depends on your risk tolerance, time horizon, and financial goals.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
