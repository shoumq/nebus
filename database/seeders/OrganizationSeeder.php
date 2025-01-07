<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizations = [
            [
                'name' => 'ООО “Рога и Копыта”',
                'building_id' => 1,
                'phone_numbers' => [
                    '2-222-222',
                    '3-333-333',
                    '8-923-666-13-13',
                ],
                'activities' => [1, 2],
            ],
            [
                'name' => 'ЗАО “Промышленность”',
                'building_id' => 2,
                'phone_numbers' => [
                    '4-444-444',
                    '8-800-555-35-35',
                ],
                'activities' => [2, 3],
            ],
            [
                'name' => 'ООО “Творчество”',
                'building_id' => 3,
                'phone_numbers' => [
                    '5-555-555',
                    '7-777-777',
                ],
                'activities' => [1, 4],
            ],
            [
                'name' => 'ООО “Технологии”',
                'building_id' => 4,
                'phone_numbers' => [
                    '6-666-666',
                    '9-999-999',
                    '8-900-111-22-33',
                ],
                'activities' => [3, 4],
            ],
        ];

        foreach ($organizations as $orgData) {
            $organization = Organization::create(['name' => $orgData['name'], 'building_id' => $orgData['building_id']]);

            foreach ($orgData['phone_numbers'] as $number) {
                $organization->phoneNumbers()->create(['number' => $number]);
            }

            $organization->activities()->attach($orgData['activities']);
        }
    }
}
