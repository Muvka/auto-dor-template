<?php

namespace App\Filament\Resources\Maintenance;

use App\Filament\Resources\Maintenance\RoadAdministrationResource\Pages;
use App\Models\MaintenanceRoadAdministration;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
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

class RoadAdministrationResource extends Resource
{
	protected static ?string $model = MaintenanceRoadAdministration::class;

	protected static ?string $navigationGroup = 'Обслуживание';

	protected static ?int $navigationSort = 20;

	protected static ?string $navigationIcon = 'heroicon-o-office-building';

	protected static ?string $label = 'Дорожное управление';

	protected static ?string $pluralLabel = 'Дорожные управления';

	protected static ?string $recordTitleAttribute = 'name';

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Card::make()
					->columns()
					->schema([
						TextInput::make('name')
							->label('Название')
							->placeholder('ДУ')
							->minLength(2)
							->maxLength(64)
							->required(),
						TextInput::make('maintained_roads_length')
							->label('Протяженность обслуживаемых дорог')
							->placeholder('150')
							->numeric()
							->minValue(0)
							->maxValue(65535)
							->default(0)
							->required(),
					]),
				Section::make('Дорожные участки')
					->columns(4)
					->hidden(fn(?MaintenanceRoadAdministration $record) => $record === null)
					->schema([
						Placeholder::make('section_quantity')
							->label('Количество')
							->content(fn(MaintenanceRoadAdministration $record): ?string => $record->sections()?->count()),
						Placeholder::make('section_list')
							->label('Список')
							->columnSpan(3)
							->content(fn(MaintenanceRoadAdministration $record): ?string => $record->sections()?->implode('name', ', ')),
					]),
				Section::make('Сотрудники')
					->columns(4)
					->schema([
						TextInput::make('employees_number')
							->label('Количество')
							->placeholder('3')
							->numeric()
							->minValue(0)
							->maxValue(65535)
							->default(0)
							->required(),
						TableRepeater::make('vacancies')
							->relationship()
							->defaultItems(0)
							->label('Вакансии')
							->headers(['Название', 'Количество'])
							->emptyLabel('Нет вакансий')
							->createItemButtonLabel('Добавить вакансию')
							->columnSpan(3)
							->orderable()
							->schema([
								TextInput::make('name')
									->disableLabel()
									->placeholder('Водитель')
									->maxLength(128)
									->required(),
								TextInput::make('number')
									->disableLabel()
									->placeholder('3')
									->numeric()
									->minValue(0)
									->maxValue(65535)
									->default(0)
									->required(),
							])
					]),
				Section::make('Сооружения')
					->columns(4)
					->schema([
						TextInput::make('buildings_number')
							->label('Количество зданий')
							->placeholder('3')
							->numeric()
							->minValue(0)
							->maxValue(65535)
							->default(0)
							->required(),
						TextInput::make('buildings_map_url')
							->label('Ссылка на карту со зданиями')
							->placeholder('https://example.ru/')
							->maxLength(255)
							->url()
							->columnSpan(3),
						TextInput::make('asphalt_plants_number')
							->label('Количество АБЗ')
							->placeholder('3')
							->numeric()
							->minValue(0)
							->maxValue(65535)
							->default(0)
							->required(),
						TextInput::make('asphalt_plants_map_url')
							->label('Ссылка на карту с АБЗ')
							->placeholder('https://example.ru/')
							->maxLength(255)
							->url()
							->columnSpan(3),
					]),
				Section::make('Машины и механизмы')
					->relationship('equipment')
					->schema([
						Tabs::make('')
							->tabs([
								Tab::make('Эксплуатация')
									->columns(3)
									->schema([
										TextInput::make('kdm_number')
											->label('КДМ')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
										TextInput::make('motor_graders_number')
											->label('Автогрейдеры')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
										TextInput::make('front_loaders_number')
											->label('Фронтальные погрузчики')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
										TextInput::make('wheeled_tractors_number')
											->label('Трактора колёсные')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
										TextInput::make('excavators_number')
											->label('Экскаваторы')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
										TextInput::make('other_exploitation_number')
											->label('Другая техника')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
									]),
								Tab::make('Строительство')
									->columns(3)
									->schema([
										TextInput::make('road_rollers_number')
											->label('Катки самоходные')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
										TextInput::make('pavers_number')
											->label('Асфальтоукладчики')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
										TextInput::make('distributors_number')
											->label('Гудронаторы')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
										TextInput::make('other_construction_number')
											->label('Другая техника')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
									]),
								Tab::make('Другая')
									->columns(3)
									->schema([
										TextInput::make('passenger_cars_number')
											->label('Легковые')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
										TextInput::make('dump_trucks_number')
											->label('Самосвалы')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
										TextInput::make('caterpillar_tractors_number')
											->label('Трактора гусеничные')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
										TextInput::make('buses_number')
											->label('Автобусы')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
										TextInput::make('trailers_number')
											->label('Прицепы')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
										TextInput::make('trailer_equipments_number')
											->label('Прицепное оборудование')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
										TextInput::make('tow_trucks_number')
											->label('Эвакуаторы')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
										TextInput::make('other_other_number')
											->label('Другая техника')
											->placeholder('1')
											->numeric()
											->minValue(0)
											->maxValue(65535)
											->default(0)
											->required(),
									]),
							]),
					]),
				Section::make('Файлы')
					->schema([
						FileUpload::make('employees_document')
							->label('ФИО и должности сотрудников:')
							->disk('private')
							->acceptedFileTypes([
								'application/pdf',
								'application/msword',
								'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
								'text/csv',
								'application/vnd.ms-excel',
								'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
							]),
					]),
			]);
	}

	public static function table(Table $table): Table
	{
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
			->actions([
				Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make()
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
			])
			->bulkActions([
				DeleteBulkAction::make()
					->action(function (Collection $records) {
						$has_sections = [];

						foreach ($records as $record) {
							if ($record->sections()->exists()) {
								$has_sections[] = $record->name;
							} else {
								$record->delete();
							}
						}

						if ( ! empty($has_sections)) {
							Notification::make()
								->title('Ошибка удаления')
								->body('"'.implode(', ', $has_sections).'" имеют один или несколько участков.')
								->danger()
								->send();
						}
					}),
			]);
	}

	public static function getPages(): array
	{
		return [
			'index' => RoadAdministrationResource\Pages\ListRoadAdministration::route('/'),
			'create' => RoadAdministrationResource\Pages\CreateRoadAdministration::route('/create'),
			'edit' => RoadAdministrationResource\Pages\EditRoadAdministration::route('/{record}/edit'),
		];
	}
}
