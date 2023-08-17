<?php

namespace App\Filament\Resources\Maintenance\RoadAdministrationResource\Pages;

use App\Filament\Resources\Maintenance\RoadAdministrationResource;
use App\Models\MaintenanceRoadAdministration;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoadAdministration extends EditRecord {
	protected static string $resource = RoadAdministrationResource::class;

	protected function getActions(): array {
		return [
			Actions\DeleteAction::make()
				->action(function (MaintenanceRoadAdministration $record) {
					if ($record->sections()->exists()) {
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
