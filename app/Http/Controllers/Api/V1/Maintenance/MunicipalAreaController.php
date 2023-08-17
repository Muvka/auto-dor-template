<?php

namespace App\Http\Controllers\Api\V1\Maintenance;

use App\Http\Controllers\Controller;
use App\Http\Resources\Maintenance\MunicipalAreaResource;
use App\Models\MaintenanceMunicipalArea;

class MunicipalAreaController extends Controller
{
	public function index()
	{
		$municipalAreas = MaintenanceMunicipalArea::select('id', 'name', 'svg_path', 'path_color')
			->with('section:id,maintenance_municipal_area_id')
			->orderBy('name', 'asc')
			->get();

		return MunicipalAreaResource::collection($municipalAreas);
	}
}
