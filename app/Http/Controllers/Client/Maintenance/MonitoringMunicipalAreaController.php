<?php

namespace App\Http\Controllers\Client\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceMunicipalArea;
use App\Models\MaintenanceRoadSection;
use App\Settings\Maintenance\GeneralSettings;
use Inertia\Inertia;

class MonitoringMunicipalAreaController extends Controller
{
	public function index()
	{
		$title = 'Мониторинг дорожной техники';

		activity()
			->log('Страница: '.$title);

		$municipalAreas = MaintenanceMunicipalArea::select([
			'id',
			'name',
			'svg_path as svgPath',
			'path_color as pathColor'
		])
			->orderBy('name')
			->get();

		return Inertia::render('Maintenance/MunicipalAreasOverviewPage', [
			'title' => $title,
			'municipalAreas' => $municipalAreas,
			'routeName' => 'client.maintenance.monitoring.municipal_areas.show'
		]);
	}

	public function show(string $id, GeneralSettings $settings)
	{
		$municipalArea = MaintenanceMunicipalArea::select('id', 'name')
			->findOrFail($id);

		$title = $municipalArea->name.' район';

		activity()
			->performedOn($municipalArea)
			->log('Страница: Мониторинг дорожной техники - '.$title);

		$roadSection = MaintenanceRoadSection::select([
			'id',
			'maintenance_municipal_area_id',
			'maintenance_road_administration_id',
			'name',
			'head',
			'address',
			'email',
			'monitoring_url',
			'information_url',
			'status'
		])
			->with([
				'administration:id,name',
				'telephones' => fn($query) => $query->orderBy('sort', 'asc'),
			])
			->where('maintenance_municipal_area_id', $id)
			->where('status', 1)
			->firstOrFail();

		return Inertia::render('Maintenance/MunicipalAreaDetailsPage', [
			'title' => $title,
			'roadSection' => [
				'name' => $roadSection->administration->name.' - '.$roadSection->name,
				'head' => $roadSection->head,
				'address' => $roadSection->address,
				'email' => $roadSection->email,
				'contactEmail' => $settings->contact_email_address,
				'serviceTelephone' => $settings->contact_service_telephone_number,
				'dispatcherTelephone' => $settings->contact_dispatcher_telephone_number,
				'telephones' => $roadSection->telephones,
				'monitoringUrl' => $roadSection->monitoring_url,
				'informationUrl' => $roadSection->information_url,
			],
		]);
	}
}
