<?php

namespace Database\Factories\Maintenance;

use App\Models\MaintenanceRoadSectionTelephone;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RoadSectionTelephoneFactory extends Factory
{
    protected $model = MaintenanceRoadSectionTelephone::class;

    public function definition(): array
    {
		$names = collect(['Стационарный', 'Мобильный']);

        return [
            'name' => $names->random(),
			'number' => fake()->unique()->phoneNumber(),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ];
    }
}
