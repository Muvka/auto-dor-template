<?php

namespace App\Filament\Resources\Maintenance\RoadProblemResource\Pages;

use App\Filament\Resources\Maintenance\RoadProblemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoadProblem extends EditRecord
{
    protected static string $resource = RoadProblemResource::class;

	protected static ?string $title = 'Редактировать проблему';

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
