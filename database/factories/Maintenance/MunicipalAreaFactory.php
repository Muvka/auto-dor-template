<?php

namespace Database\Factories\Maintenance;

use App\Models\MaintenanceMunicipalArea;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MunicipalAreaFactory extends Factory
{
	protected $model = MaintenanceMunicipalArea::class;

    public function definition(): array
    {
		return [
			'name' => fake()->city(),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
		];
    }
}
