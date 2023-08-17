<?php

namespace App\Models;

use Database\Factories\Maintenance\MunicipalAreaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MaintenanceMunicipalArea extends Model
{
	use HasFactory;

	protected $guarded = [];

	protected static function newFactory(): MunicipalAreaFactory
	{
		return MunicipalAreaFactory::new();
	}

	public function section(): HasOne {
		return $this->hasOne(MaintenanceRoadSection::class, 'maintenance_municipal_area_id');
	}
}
