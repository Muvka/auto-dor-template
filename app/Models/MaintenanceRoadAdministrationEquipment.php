<?php

namespace App\Models;

use Database\Factories\Maintenance\RoadAdministrationEquipmentFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceRoadAdministrationEquipment extends Model
{
	use HasFactory;

	protected $table = 'maintenance_road_administration_equipments';

	protected $guarded = [];

	protected static function newFactory(): RoadAdministrationEquipmentFactory
	{
		return RoadAdministrationEquipmentFactory::new();
	}

	public function administration(): BelongsTo
	{
		return $this->belongsTo(MaintenanceRoadAdministration::class, 'maintenance_road_administration_id');
	}
}
