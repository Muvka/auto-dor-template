<?php

namespace App\Filament\Resources\Maintenance\RoadSectionResource\Pages;

use App\Filament\Resources\Maintenance\RoadSectionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoadSection extends EditRecord
{
    protected static string $resource = RoadSectionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
