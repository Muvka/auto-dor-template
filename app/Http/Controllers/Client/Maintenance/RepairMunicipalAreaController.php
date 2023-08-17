<?php

namespace App\Http\Controllers\Client\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceMunicipalArea;
use App\Models\MaintenanceRoadSection;
use App\Settings\Maintenance\GeneralSettings;
use Inertia\Inertia;

class RepairMunicipalAreaController extends Controller
{
	public function index()
	{
		$municipalAreas = MaintenanceMunicipalArea::select(
			'id',
			'name',
			'svg_path as svgPath',
			'path_color as pathColor'
		)
			->orderBy('name')
			->get();

		return Inertia::render('Maintenance/MunicipalAreasOverviewPage', [
			'title' => 'Ремонт, строительство дорог',
			'municipalAreas' => $municipalAreas,
			'routeName' => 'client.maintenance.repair.municipal_areas.show'
		]);
	}

	public function show(string $id, GeneralSettings $settings)
	{
		$municipalArea = MaintenanceMunicipalArea::select(['id', 'name'])
			->findOrFail($id);
		$roadSection = MaintenanceRoadSection::select([
			'id',
			'maintenance_municipal_area_id',
			'maintenance_road_administration_id',
			'name',
			'head',
			'address',
			'email',
			'repair_url',
			'status'
		])
			->with('administration:id,name')
			->where('maintenance_municipal_area_id', $id)
			->where('status', 1)
			->firstOrFail();

		return Inertia::render('Maintenance/MunicipalAreaDetailsPage', [
			'title' => $municipalArea->name.' район',
			'roadSection' => [
				'name' => $roadSection->administration->name.' - '.$roadSection->name,
				'head' => $roadSection->head,
				'address' => $roadSection->address,
				'email' => $roadSection->email,
				'contactEmail' => $settings->contact_email_address,
				'serviceTelephone' => $settings->contact_service_telephone_number,
				'dispatcherTelephone' => $settings->contact_dispatcher_telephone_number,
				'repairUrl' => $roadSection->repair_url,
				'weatherUrl' => $settings->area_weather_url,
			],
		]);
	}
}
