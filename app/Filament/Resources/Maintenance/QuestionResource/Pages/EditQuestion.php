<?php

namespace App\Filament\Resources\Maintenance\QuestionResource\Pages;

use App\Filament\Resources\Maintenance\QuestionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestion extends EditRecord
{
    protected static string $resource = QuestionResource::class;

	protected static ?string $title = 'Редактировать вопрос';

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
