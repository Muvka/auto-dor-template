<?php

namespace Database\Seeders\Maintenance;

use App\Models\MaintenanceMunicipalArea;
use App\Models\MaintenanceRoadAdministration;
use App\Models\MaintenanceRoadSection;
use App\Models\MaintenanceRoadSectionTelephone;
use Illuminate\Database\Seeder;

class RoadSectionSeeder extends Seeder
{
    public function run(): void
    {
		foreach (range(1, 60) as $index) {
			MaintenanceRoadSection::factory()
				->for(MaintenanceMunicipalArea::factory(), 'municipalArea')
				->for(MaintenanceRoadAdministration::inRandomOrder()->first(), 'administration')
				->has(MaintenanceRoadSectionTelephone::factory()->count(random_int(0, 2)), 'telephones')
				->create();
		}
    }
}
