<?php

namespace App\Http\Resources\Maintenance;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MunicipalAreaResource extends JsonResource
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
			'svgPath' => $this->svg_path,
			'pathColor' => $this->path_color,
			'sectionId' => $this->whenLoaded('section', function () {
				return $this->section->id;
			}),
		];
    }
}
