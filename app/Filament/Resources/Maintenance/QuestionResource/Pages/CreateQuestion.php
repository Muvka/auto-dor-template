<?php

namespace App\Filament\Resources\Maintenance\QuestionResource\Pages;

use App\Filament\Resources\Maintenance\QuestionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuestion extends CreateRecord
{
    protected static string $resource = QuestionResource::class;

	protected static ?string $title = 'Добавить вопрос';
}
