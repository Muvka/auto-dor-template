<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
		$this->migrator->add('maintenance_central_office.employees_number', 0);
		$this->migrator->add('maintenance_central_office.employees_document', null);
		$this->migrator->add('maintenance_central_office.total_buildings_number', 0);
		$this->migrator->add('maintenance_central_office.buildings_number', 0);
		$this->migrator->add('maintenance_central_office.buildings_map_url', '');
		$this->migrator->add('maintenance_central_office.asphalt_plants_number', 0);
		$this->migrator->add('maintenance_central_office.asphalt_plants_map_url', '');
		$this->migrator->add('maintenance_central_office.maintained_roads_length', 0);
		$this->migrator->add('maintenance_central_office.total_equipment_number', 0);
		$this->migrator->add('maintenance_central_office.total_construction_equipment_number', 0);
		$this->migrator->add('maintenance_central_office.total_exploitation_equipment_number', 0);
		$this->migrator->add('maintenance_central_office.total_other_equipment_number', 0);
		$this->migrator->add('maintenance_central_office.passenger_cars_number', 0);
		$this->migrator->add('maintenance_central_office.dump_trucks_number', 0);
		$this->migrator->add('maintenance_central_office.kdm_number', 0);
		$this->migrator->add('maintenance_central_office.motor_graders_number', 0);
		$this->migrator->add('maintenance_central_office.front_loaders_number', 0);
		$this->migrator->add('maintenance_central_office.wheeled_tractors_number', 0);
		$this->migrator->add('maintenance_central_office.caterpillar_tractors_number', 0);
		$this->migrator->add('maintenance_central_office.road_rollers_number', 0);
		$this->migrator->add('maintenance_central_office.excavators_number', 0);
		$this->migrator->add('maintenance_central_office.buses_number', 0);
		$this->migrator->add('maintenance_central_office.trailers_number', 0);
		$this->migrator->add('maintenance_central_office.trailer_equipments_number', 0);
		$this->migrator->add('maintenance_central_office.tow_trucks_number', 0);
		$this->migrator->add('maintenance_central_office.pavers_number', 0);
		$this->migrator->add('maintenance_central_office.distributors_number', 0);
		$this->migrator->add('maintenance_central_office.other_construction_number');
		$this->migrator->add('maintenance_central_office.other_exploitation_number');
		$this->migrator->add('maintenance_central_office.other_other_number');
	}

	public function down(): void
	{
		$this->migrator->delete('maintenance_central_office.employees_number');
		$this->migrator->delete('maintenance_central_office.employees_document');
		$this->migrator->delete('maintenance_central_office.total_buildings_number');
		$this->migrator->delete('maintenance_central_office.buildings_number');
		$this->migrator->delete('maintenance_central_office.buildings_map_url');
		$this->migrator->delete('maintenance_central_office.asphalt_plants_number');
		$this->migrator->delete('maintenance_central_office.asphalt_plants_map_url');
		$this->migrator->delete('maintenance_central_office.maintained_roads_length');
		$this->migrator->delete('maintenance_central_office.total_equipment_number');
		$this->migrator->delete('maintenance_central_office.total_construction_equipment_number');
		$this->migrator->delete('maintenance_central_office.total_exploitation_equipment_number');
		$this->migrator->delete('maintenance_central_office.total_other_equipment_number');
		$this->migrator->delete('maintenance_central_office.passenger_cars_number');
		$this->migrator->delete('maintenance_central_office.dump_trucks_number');
		$this->migrator->delete('maintenance_central_office.kdm_number');
		$this->migrator->delete('maintenance_central_office.motor_graders_number');
		$this->migrator->delete('maintenance_central_office.front_loaders_number');
		$this->migrator->delete('maintenance_central_office.wheeled_tractors_number');
		$this->migrator->delete('maintenance_central_office.caterpillar_tractors_number');
		$this->migrator->delete('maintenance_central_office.road_rollers_number');
		$this->migrator->delete('maintenance_central_office.excavators_number');
		$this->migrator->delete('maintenance_central_office.buses_number');
		$this->migrator->delete('maintenance_central_office.trailers_number');
		$this->migrator->delete('maintenance_central_office.trailer_equipments_number');
		$this->migrator->delete('maintenance_central_office.tow_trucks_number');
		$this->migrator->delete('maintenance_central_office.pavers_number');
		$this->migrator->delete('maintenance_central_office.distributors_number');
		$this->migrator->delete('maintenance_central_office.other_construction_number');
		$this->migrator->delete('maintenance_central_office.other_exploitation_number');
		$this->migrator->delete('maintenance_central_office.other_other_number');
	}
};
