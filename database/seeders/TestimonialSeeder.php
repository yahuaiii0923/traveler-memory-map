<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'username' => 'ava_patel',
                'name' => 'Ava Patel',
                'role' => 'Backpacker & Blogger',
                'text' => 'Memory Mapper turned my backpacking photos into a beautiful journey.',
                'metric' => '18 Countries Captured',
                'is_public' => true
            ],
            [
                'username' => 'liam_oconnor',
                'name' => 'Liam O\'Connor',
                'role' => 'Nature Explorer',
                'text' => 'I love how intuitive the map is. It helps me organize my nature treks.',
                'metric' => '85 Trails Logged',
                'is_public' => true
            ],
            [
                'username' => 'noura_alfarsi',
                'name' => 'Noura Al-Farsi',
                'role' => 'Digital Nomad',
                'text' => 'A must-have app for anyone who travels. Easy to use and very visual!',
                'metric' => '24 Cities Pinned',
                'is_public' => true
            ],
            [
                'username' => 'james_whitmore',
                'name' => 'James Whitmore',
                'role' => 'Solo Cyclist',
                'text' => 'I use it after every ride to mark new spots I discovered. Great tool.',
                'metric' => '1,000+ KM Tracked',
                'is_public' => true
            ],
            [
                'username' => 'mei_chen',
                'name' => 'Mei Chen',
                'role' => 'Art & Culture Tourist',
                'text' => 'Every museum, mural, and meal I loved is now perfectly pinned.',
                'metric' => '73 Locations Saved',
                'is_public' => true
            ],
            [
                'username' => 'carlos_rivera',
                'name' => 'Carlos Rivera',
                'role' => 'Globetrotter',
                'text' => 'Feels like a digital scrapbook of my adventures. Love it!',
                'metric' => '39 Countries Documented',
                'is_public' => true
            ]
        ];

        foreach ($testimonials as $testimonial) {
            \App\Models\Testimonial::updateOrCreate(
                ['username' => $testimonial['username']],
                $testimonial
            );
        }
    }
}
