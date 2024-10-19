<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            'Gedung CB',
            'Gedung Maintenance',
            'Gedung TS',
            'Security',
            'Warehouse',
        ];

        foreach ($locations as $locationName) {
            Location::create([
                'name' => $locationName,
            ]);
        }
    }
}
