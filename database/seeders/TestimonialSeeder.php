<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        DB::table('testimonials')->insert([
            [
                'name' => 'John Doe',
                'message' => 'This is a sample testimonial message from John Doe.',
                'image' => 'https://via.placeholder.com/50',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Doe',
                'message' => 'This is a sample testimonial message from Jane Doe.',
                'image' => 'https://via.placeholder.com/50',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'John Smith',
                'message' => 'This is a sample testimonial message from John Smith.',
                'image' => 'https://via.placeholder.com/50',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'message' => 'This is a sample testimonial message from Jane Smith.',
                'image' => 'https://via.placeholder.com/50',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            // Add more testimonials as needed
        ]);
    }
}