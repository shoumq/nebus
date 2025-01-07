<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $food = Activity::create(['name' => 'Еда']);
        $meat = Activity::create(['name' => 'Мясная продукция', 'parent_id' => $food->id]);
        $dairy = Activity::create(['name' => 'Молочная продукция', 'parent_id' => $food->id]);

        $cars = Activity::create(['name' => 'Автомобили']);
        $trucks = Activity::create(['name' => 'Грузовые', 'parent_id' => $cars->id]);
        $passengerCars = Activity::create(['name' => 'Легковые', 'parent_id' => $cars->id]);
        $parts = Activity::create(['name' => 'Запчасти', 'parent_id' => $passengerCars->id]);
        $accessories = Activity::create(['name' => 'Аксессуары', 'parent_id' => $passengerCars->id]);
    }
}
