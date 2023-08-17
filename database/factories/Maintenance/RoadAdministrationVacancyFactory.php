<?php

namespace Database\Factories\Maintenance;

use App\Models\MaintenanceRoadAdministrationVacancy;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RoadAdministrationVacancyFactory extends Factory
{
    protected $model = MaintenanceRoadAdministrationVacancy::class;

    public function definition(): array
    {
        return [
			'name' => fake()->unique(true)->jobTitle(),
			'number' => random_int(1, 5),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ];
    }
}
