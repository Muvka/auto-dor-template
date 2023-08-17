<?php

namespace App\Filament\Resources\Maintenance\MunicipalAreaResource\Pages;

use App\Filament\Resources\Maintenance\MunicipalAreaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMunicipalArea extends ListRecords
{
    protected static string $resource = MunicipalAreaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
