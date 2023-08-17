<?php

namespace App\Http\Resources\Maintenance;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoadAdministrationEquipmentResource extends JsonResource
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
			'passengerCarsNumber' => $this->passenger_cars_number,
			'dumpTrucksNumber' => $this->dump_trucks_number,
			'kdmNumber' => $this->kdm_number,
			'motorGradersNumber' => $this->motor_graders_number,
			'frontLoadersNumber' => $this->front_loaders_number,
			'wheeledTractorsNumber' => $this->wheeled_tractors_number,
			'caterpillarTractorsNumber' => $this->caterpillar_tractors_number,
			'roadRollersNumber' => $this->road_rollers_number,
			'excavatorsNumber' => $this->excavators_number,
			'busesNumber' => $this->buses_number,
			'trailersNumber' => $this->trailers_number,
			'trailerEquipmentsNumber' => $this->trailer_equipments_number,
			'towTrucksNumber' => $this->tow_trucks_number,
			'paversNumber' => $this->pavers_number,
			'distributorsNumber' => $this->distributors_number,
			'otherConstructionNumber' => $this->other_construction_number,
			'otherExploitationNumber' => $this->other_exploitation_number,
			'otherOtherNumber' => $this->other_other_number,
		];
    }
}
