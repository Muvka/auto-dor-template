<?php

namespace App\Http\Resources\Maintenance;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoadAdministrationResource extends JsonResource
{
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			$this->mergeWhen(auth('sanctum')->check(), [
				'employeesNumber' => $this->employees_number,
				'employeesDocument' => $this->employees_document,
				'buildingsNumber' => $this->buildings_number,
				'buildingsMapUrl' => $this->buildings_map_url,
				'asphaltPlantsNumber' => $this->asphalt_plants_number,
				'asphaltPlantsMapUrl' => $this->asphalt_plants_map_url,
				'maintainedRoadsLength' => $this->maintained_roads_length,
				'equipment' => new RoadAdministrationEquipmentResource($this->whenLoaded('equipment')),
				'vacancies' => RoadAdministrationVacancyResource::collection($this->whenLoaded('vacancies')),
				'sectionIds' => $this->whenLoaded('sections', function () {
					return $this->sections->map(function ($section) {
						return $section->id;
					});
				}),
			]),
		];
	}
}
