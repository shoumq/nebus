<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buildings = [
            [
                'address' => 'г. Москва, ул. Ленина 1, офис 3',
                'latitude' => 55.7558,
                'longitude' => 37.6173,
            ],
            [
                'address' => 'г. Москва, ул. Тверская 12, офис 5',
                'latitude' => 55.7555,
                'longitude' => 37.6170,
            ],
            [
                'address' => 'г. Москва, ул. Арбат 20, офис 2',
                'latitude' => 55.7465,
                'longitude' => 37.6050,
            ],
            [
                'address' => 'г. Санкт-Петербург, Невский проспект 28',
                'latitude' => 59.9343,
                'longitude' => 30.3351,
            ],
            [
                'address' => 'г. Казань, ул. Баумана 1',
                'latitude' => 55.7952,
                'longitude' => 49.1064,
            ],
            [
                'address' => 'г. Новосибирск, Красный проспект 24',
                'latitude' => 55.0084,
                'longitude' => 82.9357,
            ],
            [
                'address' => 'г. Екатеринбург, ул. Малышева 51',
                'latitude' => 56.8389,
                'longitude' => 60.6057,
            ],
        ];

        foreach ($buildings as $building) {
            Building::create($building);
        }
    }
}
