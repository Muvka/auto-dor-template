<?php

namespace App\Filament\Resources\Maintenance;

use App\Filament\Resources\Maintenance\MunicipalAreaResource\Pages;
use App\Models\MaintenanceMunicipalArea;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Collection;
use stdClass;

class MunicipalAreaResource extends Resource {
	protected static ?string $model = MaintenanceMunicipalArea::class;

	protected static ?string $navigationGroup = 'Обслуживание';

	protected static ?int $navigationSort = 10;

	protected static ?string $navigationIcon = 'heroicon-o-map';

	protected static ?string $label = 'Муниципальный район';

	protected static ?string $pluralLabel = 'Муниципальные районы';

	protected static ?string $recordTitleAttribute = 'name';

	public static function form(Form $form): Form {
		return $form
			->schema([
				Card::make()
					->schema([
						TextInput::make('name')
							->label('Название')
							->minLength(2)
							->maxLength(32)
							->required(),
					]),
				Section::make('Карта')
					->schema([
						Textarea::make('svg_path')
							->label('Координаты полигона')
							->rows(3),
						ColorPicker::make('path_color')
							->label('Цвет полигона')
							->requiredWith('svg_path'),
					]),
			]);
	}

	public static function table(Table $table): Table {
		return $table
			->columns([
				TextColumn::make('№')
					->getStateUsing(
						static function (stdClass $rowLoop, HasTable $livewire): string {
							return (string) (
								$rowLoop->iteration +
								($livewire->tableRecordsPerPage * (
										$livewire->page - 1
									))
							);
						}
					),
				TextColumn::make('name')
					->label('Название')
					->sortable(),
			])
			->filters([
				//
			])
			->actions([
				Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make()->action(function (MaintenanceMunicipalArea $record) {
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
			])
			->bulkActions([
				DeleteBulkAction::make()->action(function (Collection $records) {
					$has_sections = [];

					foreach ($records as $record) {
						if ($record->section()->exists()) {
							$has_sections[] = $record->name;
						} else {
							$record->delete();
						}
					}

					if (!empty($has_sections)) {
						Notification::make()
							->title('Ошибка удаления')
							->body('"' . implode(', ', $has_sections) . '" имеют один или несколько участков.')
							->danger()
							->send();
					}
				}),
			]);
	}

	public static function getPages(): array {
		return [
			'index' => MunicipalAreaResource\Pages\ListMunicipalArea::route('/'),
			'create' => MunicipalAreaResource\Pages\CreateMunicipalArea::route('/create'),
			'edit' => MunicipalAreaResource\Pages\EditMunicipalArea::route('/{record}/edit'),
		];
	}
}
