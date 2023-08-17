<?php

namespace App\Filament\Resources\Maintenance\QuestionResource\Pages;

use App\Filament\Resources\Maintenance\QuestionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestions extends ListRecords
{
    protected static string $resource = QuestionResource::class;

	protected static ?string $title = 'Список вопросов';

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
