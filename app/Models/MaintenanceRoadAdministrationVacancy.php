<?php

namespace App\Models;

use Database\Factories\Maintenance\RoadAdministrationVacancyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceRoadAdministrationVacancy extends Model
{
	use HasFactory;

	protected $guarded = [];

	protected static function newFactory(): RoadAdministrationVacancyFactory
	{
		return RoadAdministrationVacancyFactory::new();
	}

	public function administration(): BelongsTo {
		return $this->belongsTo(MaintenanceRoadAdministration::class, 'maintenance_road_administration_id');
	}
}
