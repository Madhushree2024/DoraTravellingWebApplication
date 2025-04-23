<?php

namespace Database\Seeders;

use App\Models\AdventureTrip;
use Illuminate\Database\Seeder;

class AdventureTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trips = [
            [
                'name' => 'Himalayan Trek Adventure',
                'description' => 'Experience the breathtaking beauty of the Himalayas on this challenging trek. Perfect for experienced hikers looking for an unforgettable adventure.',
                'location' => 'Nepal',
                'difficulty' => 'challenging',
                'price' => 1299.99,
                'duration' => 14,
                'image_url' => 'himalayan.jpg',
            ],
            [
                'name' => 'Amazon Rainforest Expedition',
                'description' => 'Explore the incredible biodiversity of the Amazon rainforest. Guided tours, wildlife spotting, and authentic local experiences.',
                'location' => 'Brazil',
                'difficulty' => 'moderate',
                'price' => 899.99,
                'duration' => 10,
                'image_url' => 'amazon.jpg',
            ],
            [
                'name' => 'Safari Adventure in Serengeti',
                'description' => 'Witness the amazing wildlife of Africa on this safari adventure. See lions, elephants, giraffes and more in their natural habitat.',
                'location' => 'Tanzania',
                'difficulty' => 'easy',
                'price' => 2499.99,
                'duration' => 7,
                'image_url' => 'safari.png',
            ],
            [
                'name' => 'Iceland Glacier Hike',
                'description' => 'Trek across stunning glaciers and experience the unique landscape of Iceland. Includes visit to geysers and famous waterfalls.',
                'location' => 'Iceland',
                'difficulty' => 'moderate',
                'price' => 1599.99,
                'duration' => 8,
                'image_url' => 'ice.png',
            ],
            [
                'name' => 'Grand Canyon Rafting Trip',
                'description' => 'Navigate the thrilling rapids of the Colorado River through the Grand Canyon. A perfect blend of adventure and natural wonder.',
                'location' => 'USA',
                'difficulty' => 'challenging',
                'price' => 1199.99,
                'duration' => 5,
                'image_url' => 'Rafting.jpg',
            ],
            [
                'name' => 'New Zealand Extreme Adventure',
                'description' => 'The ultimate adrenaline package: bungee jumping, skydiving, and white-water rafting in the adventure capital of the world.',
                'location' => 'New Zealand',
                'difficulty' => 'extreme',
                'price' => 2299.99,
                'duration' => 12,
                'image_url' => 'new-zealand.jpg',
            ],
            [
                'name' => 'Bali Tropical Paradise',
                'description' => 'Relax on beautiful beaches, explore ancient temples, and enjoy the local culture on this easy-going tropical adventure.',
                'location' => 'Indonesia',
                'difficulty' => 'easy',
                'price' => 899.99,
                'duration' => 9,
                'image_url' => 'bali.png',
            ],
            [
                'name' => 'Swiss Alps Mountain Biking',
                'description' => 'Ride through stunning alpine scenery on this mountain biking adventure. Suitable for intermediate to advanced riders.',
                'location' => 'Switzerland',
                'difficulty' => 'challenging',
                'price' => 1399.99,
                'duration' => 6,
                'image_url' => 'biking.jpg',
            ]
        ];

        foreach ($trips as $trip) {
            AdventureTrip::create($trip);
        }
    }
}