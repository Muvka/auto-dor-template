<?php

namespace App\Http\Controllers\Api\V1\Maintenance;

use App\Http\Controllers\Controller;
use App\Http\Resources\Maintenance\RoadAdministrationResource;
use App\Models\MaintenanceRoadAdministration;

class RoadAdministrationController extends Controller
{
	public function index()
	{
		$roadAdministrations = MaintenanceRoadAdministration::with([
				'vacancies' => function ($query) {
					$query->orderBy('sort', 'asc');
				}
			])
			->with(
				'sections:id,maintenance_road_administration_id',
				'equipment',
			)
			->orderBy('sort', 'asc')
			->get();

		return RoadAdministrationResource::collection($roadAdministrations);
	}
}
