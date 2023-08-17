<?php

namespace App\Http\Controllers\Api\V1\Maintenance;

use App\Http\Controllers\Controller;
use App\Http\Resources\Maintenance\RoadSectionResource;
use App\Models\MaintenanceRoadSection;
use Illuminate\Http\Request;

class RoadSectionController extends Controller
{
	public function index()
	{
		$roadSections = MaintenanceRoadSection::where('status', 1)
			->with(
				[
					'municipalArea:id',
					'administration:id',
					'telephones' => fn($query) => $query->orderBy('sort', 'asc'),
				]
			)
			->get();

		return RoadSectionResource::collection($roadSections);
	}
}
