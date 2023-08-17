<?php

namespace App\Http\Resources\Maintenance;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoadSectionResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'head' => $this->head,
			'address' => $this->address,
			'email' => $this->email,
			'maintenanceUrl' => $this->maintenance_url,
			'repairUrl' => $this->repair_url,
			$this->mergeWhen(auth('sanctum')->check(), [
				'monitoringUrl' => $this->monitoring_url,
				'informationUrl' => $this->information_url,
				'telephones' => RoadSectionTelephoneResource::collection($this->whenLoaded('telephones')),
			]),
			'municipalAreaId' => $this->whenLoaded('municipalArea', function () {
				return $this->municipalArea->id;
			}),
			'administrationId' => $this->whenLoaded('administration', function () {
				return $this->administration->id;
			}),
		];
	}
}
