<?php

namespace App\Http\Controllers\Client\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRoadAdministration;
use App\Settings\Maintenance\CentralOfficeSettings;
use Inertia\Inertia;

class CentralOfficeController extends Controller
{
	public function __invoke(CentralOfficeSettings $centralOfficeSettings)
	{
		$title = 'Центральный аппарат';

		activity()
			->log('Страница: '.$title);

		$roadAdministrations = MaintenanceRoadAdministration::select(
			'id',
			'name',
			'sort',
		)
			->withCount('sections as sections')
			->orderBy('sort', 'asc')
			->get();

		$employeesDocument = null;

		if ($centralOfficeSettings->employees_document) {
			$employeesDocumentName = 'Сотрудники.'.pathinfo(storage_path($centralOfficeSettings->employees_document),
					PATHINFO_EXTENSION);

			$employeesDocument = [
				'name' => $employeesDocumentName,
				'url' => route('client.shared.files.private.download', [
					'file' => $centralOfficeSettings->employees_document,
					'name' => $employeesDocumentName
				])
			];
		}

		return Inertia::render('Maintenance/CentralOfficePage', [
			'title' => $title,
			'centralOffice' => [
				'employeesNumber' => $centralOfficeSettings->employees_number,
				'employeesDocument' => $employeesDocument,
				'totalBuildingsNumber' => $centralOfficeSettings->total_buildings_number,
				'buildingsNumber' => $centralOfficeSettings->buildings_number,
				'buildingsMapUrl' => $centralOfficeSettings->buildings_map_url,
				'asphaltPlantsNumber' => $centralOfficeSettings->asphalt_plants_number,
				'asphaltPlantsMapUrl' => $centralOfficeSettings->asphalt_plants_map_url,
				'maintainedRoadsLength' => $centralOfficeSettings->maintained_roads_length,
				'totalEquipmentNumber' => $centralOfficeSettings->total_equipment_number,
				'totalConstructionEquipmentNumber' => $centralOfficeSettings->total_construction_equipment_number,
				'totalExploitationEquipmentNumber' => $centralOfficeSettings->total_exploitation_equipment_number,
				'totalOtherEquipmentNumber' => $centralOfficeSettings->total_other_equipment_number,
				'passengerCarsNumber' => $centralOfficeSettings->passenger_cars_number,
				'dumpTrucksNumber' => $centralOfficeSettings->dump_trucks_number,
				'kdmNumber' => $centralOfficeSettings->kdm_number,
				'motorGradersNumber' => $centralOfficeSettings->motor_graders_number,
				'frontLoadersNumber' => $centralOfficeSettings->front_loaders_number,
				'wheeledTractorsNumber' => $centralOfficeSettings->wheeled_tractors_number,
				'caterpillarTractorsNumber' => $centralOfficeSettings->caterpillar_tractors_number,
				'roadRollersNumber' => $centralOfficeSettings->road_rollers_number,
				'excavatorsNumber' => $centralOfficeSettings->excavators_number,
				'busesNumber' => $centralOfficeSettings->buses_number,
				'trailersNumber' => $centralOfficeSettings->trailers_number,
				'trailerEquipmentsNumber' => $centralOfficeSettings->trailer_equipments_number,
				'towTrucksNumber' => $centralOfficeSettings->tow_trucks_number,
				'paversNumber' => $centralOfficeSettings->pavers_number,
				'distributorsNumber' => $centralOfficeSettings->distributors_number,
				'otherConstructionNumber' => $centralOfficeSettings->other_construction_number,
				'otherExploitationNumber' => $centralOfficeSettings->other_exploitation_number,
				'otherOtherNumber' => $centralOfficeSettings->other_other_number,
			],
			'roadAdministrations' => $roadAdministrations,
		]);
	}
}
