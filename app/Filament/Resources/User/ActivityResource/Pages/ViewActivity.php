<?php

namespace App\Filament\Resources\User\ActivityResource\Pages;

use App\Filament\Resources\User\ActivityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewActivity extends ViewRecord
{
    protected static string $resource = ActivityResource::class;

    protected function getActions(): array
    {
        return [
//            Actions\EditAction::make(),
        ];
    }
}
