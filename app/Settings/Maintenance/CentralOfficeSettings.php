<?php

namespace App\Settings\Maintenance;

use Spatie\LaravelSettings\Settings;

class CentralOfficeSettings extends Settings
{
	public int $employees_number;

	public ?string $employees_document;

	public int $total_buildings_number;

	public int $buildings_number;

	public ?string $buildings_map_url;

	public int $asphalt_plants_number;

	public ?string $asphalt_plants_map_url;

	public int $maintained_roads_length;

	public int $total_equipment_number;

	public int $total_construction_equipment_number;

	public int $total_exploitation_equipment_number;

	public int $total_other_equipment_number;

	public int $passenger_cars_number;

	public int $dump_trucks_number;

	public int $kdm_number;

	public int $motor_graders_number;

	public int $front_loaders_number;

	public int $wheeled_tractors_number;

	public int $caterpillar_tractors_number;

	public int $road_rollers_number;

	public int $excavators_number;

	public int $buses_number;

	public int $trailers_number;

	public int $trailer_equipments_number;

	public int $tow_trucks_number;

	public int $pavers_number;

	public int $distributors_number;

	public ?int $other_construction_number;

	public ?int $other_exploitation_number;

	public ?int $other_other_number;

    public static function group(): string
    {
        return 'maintenance_central_office';
    }
}
