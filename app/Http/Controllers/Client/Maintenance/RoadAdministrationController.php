<?php

namespace App\Http\Controllers\Client\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRoadAdministration;
use Inertia\Inertia;

class RoadAdministrationController extends Controller
{
	public function index()
	{
		$title = 'Дорожные управления';
		activity()
			->log('Страница: '.$title);

		$roadAdministrations = MaintenanceRoadAdministration::select('id', 'name', 'sort')
			->orderBy('sort', 'asc')
			->get();

		return Inertia::render('Maintenance/RoadAdministrationsOverviewPage', [
			'title' => $title,
			'roadAdministrations' => $roadAdministrations,
		]);
	}

	public function show(string $id)
	{
		$roadAdministration = MaintenanceRoadAdministration::with([
			'sections' => function ($query) {
				$query->select('id', 'maintenance_road_administration_id', 'name')->orderBy('name');
			},
			'vacancies' => function ($query) {
				$query->select('id', 'maintenance_road_administration_id', 'name', 'number', 'sort')->orderBy('sort');
			},
			'equipment' => function ($query) {
				$query->select(
					'maintenance_road_administration_id',
					\DB::raw('(SUM(road_rollers_number) + SUM(pavers_number) + SUM(distributors_number) + SUM(other_construction_number)) as totalConstructionEquipmentNumber'),
					\DB::raw('(SUM(kdm_number) + SUM(motor_graders_number) + SUM(front_loaders_number) + SUM(wheeled_tractors_number) + SUM(excavators_number) + SUM(tow_trucks_number) + SUM(other_exploitation_number)) as totalExploitationEquipmentNumber'),
					\DB::raw('(SUM(passenger_cars_number) + SUM(dump_trucks_number) + SUM(caterpillar_tractors_number) + SUM(buses_number) + SUM(trailers_number) + SUM(trailer_equipments_number) + SUM(other_other_number)) as totalOtherEquipmentNumber'),
				);
			},
		])->findOrFail($id);

		activity()
			->performedOn($roadAdministration)
			->log('Страница: Дорожное управление - '.$roadAdministration->name);

		$employeesDocument = null;

		if ($roadAdministration->employees_document) {
			$employeesDocumentName = 'Сотрудники.'.pathinfo(storage_path($roadAdministration->employees_document),
					PATHINFO_EXTENSION);

			$employeesDocument = [
				'name' => $employeesDocumentName,
				'url' => route('client.shared.files.private.download', [
					'file' => $roadAdministration->employees_document,
					'name' => $employeesDocumentName
				])
			];
		}

		return Inertia::render('Maintenance/RoadAdministrationDetailsPage', [
			'title' => $roadAdministration->name,
			'roadAdministration' => [
				'name' => $roadAdministration->name,
				'sections' => $roadAdministration->sections,
				'vacancies' => $roadAdministration->vacancies,
				'employeesNumber' => $roadAdministration->employees_number,
				'employeesDocument' => $employeesDocument,
				'buildingsNumber' => $roadAdministration->buildings_number,
				'buildingsMapUrl' => $roadAdministration->buildings_map_url,
				'asphaltPlantsNumber' => $roadAdministration->asphalt_plants_number,
				'asphaltPlantsMapUrl' => $roadAdministration->asphalt_plants_map_url,
				'maintainedRoadsLength' => $roadAdministration->maintained_roads_length,
				'totalConstructionEquipmentNumber' => $roadAdministration->equipment->totalConstructionEquipmentNumber,
				'totalExploitationEquipmentNumber' => $roadAdministration->equipment->totalExploitationEquipmentNumber,
				'totalOtherEquipmentNumber' => $roadAdministration->equipment->totalOtherEquipmentNumber,
			],
		]);
	}
}
