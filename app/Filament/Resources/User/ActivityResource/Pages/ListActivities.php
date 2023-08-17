<?php

namespace App\Filament\Resources\User\ActivityResource\Pages;

use App\Filament\Resources\User\ActivityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActivities extends ListRecords
{
    protected static string $resource = ActivityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
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
