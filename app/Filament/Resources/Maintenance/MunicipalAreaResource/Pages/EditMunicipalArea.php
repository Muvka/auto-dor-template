<?php

namespace App\Filament\Resources\Maintenance\MunicipalAreaResource\Pages;

use App\Filament\Resources\Maintenance\MunicipalAreaResource;
use App\Models\MaintenanceMunicipalArea;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMunicipalArea extends EditRecord {
	protected static string $resource = MunicipalAreaResource::class;

	protected function getActions(): array {
		return [
			Actions\DeleteAction::make()
				->action(function (MaintenanceMunicipalArea $record) {
					if ($record->section()->exists()) {
						Notification::make()
							->title('Ошибка удаления')
							->body("\"$record->name\" имеет один или несколько участков.")
							->danger()
							->send();
					} else {
						$record->delete();
					}
				}),
		];
	}
}
