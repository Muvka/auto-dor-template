<?php

namespace App\Models;

use Database\Factories\Maintenance\RoadSectionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaintenanceRoadSection extends Model
{
	use HasFactory;

	protected $guarded = [];

	protected static function newFactory(): RoadSectionFactory
	{
		return RoadSectionFactory::new();
	}

	public function municipalArea(): BelongsTo {
		return $this->belongsTo(MaintenanceMunicipalArea::class, 'maintenance_municipal_area_id');
	}

    public function administration(): BelongsTo {
        return $this->belongsTo(MaintenanceRoadAdministration::class, 'maintenance_road_administration_id');
    }

	public function telephones(): HasMany {
		return $this->hasMany(MaintenanceRoadSectionTelephone::class, 'maintenance_road_section_id');
	}
}
