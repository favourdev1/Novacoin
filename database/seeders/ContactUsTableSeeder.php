<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContactUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insert a single entry
        DB::table('contact_us')->insert([
            'user_id' => 1, // Assuming you have a user with ID 1
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'subject' => 'Inquiry',
            'message' => 'This is a sample inquiry message.',
            'status' => 'unread',
            'ip_address' => '127.0.0.1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // For multiple entries, consider using a loop or factory (if using Laravel 8 or newer)
    }
}