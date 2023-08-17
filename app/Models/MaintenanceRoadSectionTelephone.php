<?php

namespace App\Models;

use Database\Factories\Maintenance\RoadSectionTelephoneFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MaintenanceRoadSectionTelephone extends Model
{
	use HasFactory;

	protected $guarded = [];

	protected static function newFactory(): RoadSectionTelephoneFactory
	{
		return RoadSectionTelephoneFactory::new();
	}

	/**
	 * Получить дорожный участок, которому принадлежит номер телефона
	 *
	 * @return HasOne
	 */
	public function section(): BelongsTo {
		return $this->belongsTo(MaintenanceRoadSection::class, 'maintenance_road_section_id');
	}
}
