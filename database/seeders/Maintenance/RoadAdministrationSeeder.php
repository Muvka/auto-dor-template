<?php

namespace Database\Seeders\Maintenance;

use App\Models\MaintenanceRoadAdministration;
use App\Models\MaintenanceRoadAdministrationEquipment;
use App\Models\MaintenanceRoadAdministrationVacancy;
use Illuminate\Database\Seeder;

class RoadAdministrationSeeder extends Seeder
{
    public function run(): void
    {
        MaintenanceRoadAdministration::factory()
			->has(MaintenanceRoadAdministrationEquipment::factory(), 'equipment')
			->has(MaintenanceRoadAdministrationVacancy::factory()->count(random_int(1, 7)), 'vacancies')
			->count(10)
			->create();
    }
}
