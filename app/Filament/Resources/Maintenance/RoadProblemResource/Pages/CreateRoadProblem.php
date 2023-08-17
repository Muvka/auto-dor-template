<?php

namespace App\Filament\Resources\Maintenance\RoadProblemResource\Pages;

use App\Filament\Resources\Maintenance\RoadProblemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRoadProblem extends CreateRecord
{
    protected static string $resource = RoadProblemResource::class;

	protected static ?string $title = 'Добавить проблему';
}
