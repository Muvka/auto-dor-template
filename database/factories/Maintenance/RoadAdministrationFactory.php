<?php

namespace Database\Factories\Maintenance;

use App\Models\MaintenanceRoadAdministration;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RoadAdministrationFactory extends Factory
{
    protected $model = MaintenanceRoadAdministration::class;

    public function definition(): array
    {
        return [
			'name' => sprintf('%s ДУ №%s', fake()->city(), random_int(1, 20)),
			'employees_number' => random_int(1, 200),
			'buildings_number' => random_int(1, 20),
			'asphalt_plants_number' => random_int(1, 20),
			'maintained_roads_length' => random_int(1, 2000),
			'buildings_map_url' => 'https://yandex.ru/maps/',
			'asphalt_plants_map_url' => 'https://yandex.ru/maps/',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ];
    }
}
