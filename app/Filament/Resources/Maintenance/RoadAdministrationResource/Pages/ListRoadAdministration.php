<?php

namespace App\Filament\Resources\Maintenance\RoadAdministrationResource\Pages;

use App\Filament\Resources\Maintenance\RoadAdministrationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoadAdministration extends ListRecords
{
    protected static string $resource = RoadAdministrationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

	protected function getTableReorderColumn(): ?string
	{
		return 'sort';
	}
}
