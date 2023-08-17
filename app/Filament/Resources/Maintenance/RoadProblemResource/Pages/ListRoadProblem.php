<?php

namespace App\Filament\Resources\Maintenance\RoadProblemResource\Pages;

use App\Filament\Resources\Maintenance\RoadProblemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoadProblem extends ListRecords
{
    protected static string $resource = RoadProblemResource::class;

	protected static ?string $title = 'Список проблем';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

	protected function getHeaderWidgets(): array
	{
		return RoadProblemResource::getWidgets();
	}

	protected function getDefaultTableSortColumn(): ?string
	{
		return 'id';
	}

	protected function getDefaultTableSortDirection(): ?string
	{
		return 'desc';
	}
}
