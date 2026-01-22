<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'Deluxe Suite',
                'description' => 'Spacious suite with a king-size bed, modern amenities, and a beautiful view of the countryside.',
                'price' => 150.00,
                'capacity' => 2,
                'status' => 'available',
            ],
            [
                'name' => 'Family Room',
                'description' => 'Perfect for families with two queen beds, plenty of space, and entertainment options.',
                'price' => 200.00,
                'capacity' => 4,
                'status' => 'available',
            ],
            [
                'name' => 'Standard Room',
                'description' => 'Comfortable room with a queen bed, basic amenities, and cozy atmosphere.',
                'price' => 100.00,
                'capacity' => 2,
                'status' => 'available',
            ],
            [
                'name' => 'Executive Suite',
                'description' => 'Luxury suite with premium furnishings, separate living area, and exclusive amenities.',
                'price' => 250.00,
                'capacity' => 2,
                'status' => 'available',
            ],
            [
                'name' => 'Budget Room',
                'description' => 'Affordable accommodation with essential amenities and clean, simple design.',
                'price' => 75.00,
                'capacity' => 1,
                'status' => 'available',
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
