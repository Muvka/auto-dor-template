<?php

namespace Database\Factories\Maintenance;

use App\Models\MaintenanceRoadSection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RoadSectionFactory extends Factory
{
    protected $model = MaintenanceRoadSection::class;

    public function definition(): array
    {
        return [
            'name' => fake()->city().' дорожный участок',
			'head' => fake()->unique()->name(),
			'address' => fake()->address(),
			'email' => fake()->unique()->email(),
			'maintenance_url' => 'https://yandex.ru/maps/',
			'repair_url' => 'https://yandex.ru/maps/',
			'monitoring_url' => 'https://yandex.ru/maps/',
			'information_url' => 'https://yandex.ru/maps/',
			'status' => true,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ];
    }
}
