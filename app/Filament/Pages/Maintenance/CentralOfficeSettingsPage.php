<?php

namespace App\Filament\Pages\Maintenance;

use App\Settings\Maintenance\CentralOfficeSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;

class CentralOfficeSettingsPage extends SettingsPage
{
	protected static ?string $navigationGroup = 'Обслуживание';

	protected static ?int $navigationSort = 5;

	protected static ?string $navigationIcon = 'heroicon-o-office-building';

	protected static ?string $slug = 'maintenance-central-office-settings';

	protected static ?string $title = 'Центральный аппарат';

	protected static string $settings = CentralOfficeSettings::class;

	protected function getFormSchema(): array
	{
		return [
			Section::make('Сотрудники')
				->columns()
				->schema([
					TextInput::make('employees_number')
						->label('Количество сотрудников')
						->placeholder('10')
						->default(0)
						->minValue(0)
						->maxValue(65535)
						->numeric()
						->required(),
					FileUpload::make('employees_document')
						->label('Документ:')
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
			Section::make('Здания и сооружения')
				->columns(4)
				->schema([
					TextInput::make('total_buildings_number')
						->label('Всего')
						->placeholder('10')
						->default(0)
						->minValue(0)
						->maxValue(65535)
						->numeric()
						->required()
						->columnSpanFull(),
					TextInput::make('buildings_number')
						->label('Количество зданий, сооружений')
						->placeholder('10')
						->default(0)
						->minValue(0)
						->maxValue(65535)
						->numeric()
						->required(),
					TextInput::make('buildings_map_url')
						->label('Ссылка на карту (здания и сооружения)')
						->placeholder('https://example.ru/')
						->url()
						->columnSpan(3),
					TextInput::make('asphalt_plants_number')
						->label('Количество АБЗ')
						->placeholder('10')
						->default(0)
						->minValue(0)
						->maxValue(65535)
						->numeric()
						->required(),
					TextInput::make('asphalt_plants_map_url')
						->label('Ссылка на карту (АБЗ)')
						->placeholder('https://example.ru/')
						->url()
						->columnSpan(3),
				]),
			Section::make('Машины и механизмы')
				->columns(4)
				->schema([
					TextInput::make('total_equipment_number')
						->label('Количество техники')
						->placeholder('10')
						->default(0)
						->minValue(0)
						->maxValue(65535)
						->numeric()
						->required(),
					TextInput::make('total_construction_equipment_number')
						->label('Количество дорожной техники (строительство)')
						->placeholder('10')
						->default(0)
						->minValue(0)
						->maxValue(65535)
						->numeric()
						->required(),
					TextInput::make('total_exploitation_equipment_number')
						->label('Количество дорожной техники (эксплуатация)')
						->placeholder('10')
						->default(0)
						->minValue(0)
						->maxValue(65535)
						->numeric()
						->required(),
					TextInput::make('total_other_equipment_number')
						->label('Количество дорожной техники (другая: тралы, самосвалы, автобусы)')
						->placeholder('10')
						->default(0)
						->minValue(0)
						->maxValue(65535)
						->numeric()
						->required(),
					Tabs::make('Техника')
						->disableLabel()
						->columnSpanFull()
						->tabs([
							Tab::make('Эксплуатация')
								->columns(4)
								->schema([
									TextInput::make('kdm_number')
										->label('КДМ')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
									TextInput::make('motor_graders_number')
										->label('Автогрейдеры')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
									TextInput::make('front_loaders_number')
										->label('Фронтальные погрузчики')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
									TextInput::make('wheeled_tractors_number')
										->label('Трактора колёсные')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
									TextInput::make('excavators_number')
										->label('Экскаваторы')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
									TextInput::make('other_exploitation_number')
										->label('Другая техника')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
								]),
							Tab::make('Строительство')
								->columns(4)
								->schema([
									TextInput::make('road_rollers_number')
										->label('Катки самоходные')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
									TextInput::make('pavers_number')
										->label('Асфальтоукладчики')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
									TextInput::make('distributors_number')
										->label('Гудронаторы')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
									TextInput::make('other_construction_number')
										->label('Другая техника')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
								]),
							Tab::make('Другая')
								->columns(4)
								->schema([
									TextInput::make('passenger_cars_number')
										->label('Легковые')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
									TextInput::make('dump_trucks_number')
										->label('Самосвалы')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
									TextInput::make('caterpillar_tractors_number')
										->label('Трактора гусеничные')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
									TextInput::make('buses_number')
										->label('Автобусы')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
									TextInput::make('trailers_number')
										->label('Прицепы')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
									TextInput::make('trailer_equipments_number')
										->label('Прицепное оборудование')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
									TextInput::make('tow_trucks_number')
										->label('Эвакуаторы')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
									TextInput::make('other_other_number')
										->label('Другая техника')
										->placeholder('10')
										->numeric()
										->minValue(0)
										->maxValue(65535)
										->default(0)
										->required(),
								]),
						]),
				]),
			Section::make('Разное')
				->columns()
				->schema([
					TextInput::make('maintained_roads_length')
						->label('Протяжённость обслуживаемых дорог')
						->placeholder('10')
						->default(0)
						->minValue(0)
						->maxValue(65535)
						->numeric()
						->required(),
				]),
		];
	}
}
