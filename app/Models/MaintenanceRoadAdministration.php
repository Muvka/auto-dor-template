<?php

namespace App\Models;

use Database\Factories\Maintenance\RoadAdministrationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MaintenanceRoadAdministration extends Model
{
	use HasFactory;

	protected $guarded = [];

	protected static function newFactory()
	{
		return RoadAdministrationFactory::new();
	}

	public function sections(): HasMany
	{
		return $this->hasMany(MaintenanceRoadSection::class, 'maintenance_road_administration_id');
	}

	public function vacancies(): HasMany
	{
		return $this->hasMany(MaintenanceRoadAdministrationVacancy::class, 'maintenance_road_administration_id');
	}

	public function equipment(): hasOne
	{
		return $this->hasOne(MaintenanceRoadAdministrationEquipment::class, 'maintenance_road_administration_id');
	}
}
