<?php

namespace Database\Factories\Maintenance;

use App\Models\MaintenanceRoadAdministrationEquipment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RoadAdministrationEquipmentFactory extends Factory
{
    protected $model = MaintenanceRoadAdministrationEquipment::class;

    public function definition(): array
    {
        return [
            'passenger_cars_number' => random_int(1, 30),
            'dump_trucks_number' => random_int(1, 30),
            'kdm_number' => random_int(1, 30),
            'motor_graders_number' => random_int(1, 30),
            'front_loaders_number' => random_int(1, 30),
            'wheeled_tractors_number' => random_int(1, 30),
            'caterpillar_tractors_number' => random_int(1, 30),
            'road_rollers_number' => random_int(1, 30),
            'excavators_number' => random_int(1, 30),
            'buses_number' => random_int(1, 30),
			'trailers_number' => random_int(1, 30),
			'trailer_equipments_number' => random_int(1, 30),
			'tow_trucks_number' => random_int(1, 30),
			'pavers_number' => random_int(1, 30),
			'distributors_number' => random_int(1, 30),
			'other_construction_number' => random_int(1, 30),
			'other_exploitation_number' => random_int(1, 30),
			'other_other_number' => random_int(1, 30),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ];
    }
}
