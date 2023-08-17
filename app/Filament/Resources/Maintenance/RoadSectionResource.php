<?php

namespace App\Filament\Resources\Maintenance;

use App\Filament\Resources\Maintenance\RoadSectionResource\Pages;
use App\Models\MaintenanceRoadSection;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Contracts\HasTable;
use stdClass;

class RoadSectionResource extends Resource
{
	protected static ?string $model = MaintenanceRoadSection::class;

	protected static ?string $navigationGroup = 'Обслуживание';

	protected static ?int $navigationSort = 30;

	protected static ?string $navigationIcon = 'heroicon-o-flag';

	protected static ?string $label = 'Дорожный участок';

	protected static ?string $pluralLabel = 'Дорожные участки';

	protected static ?string $recordTitleAttribute = 'name';

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Card::make()->columns()->schema([
					TextInput::make('name')
						->label('Название')
						->minLength(2)
						->maxLength(64)
						->required(),
					Select::make('maintenance_road_administration_id')
						->relationship('administration', 'name')
						->label('Управление')
						->required(),
					Select::make('maintenance_municipal_area_id')
						->relationship('municipalArea', 'name')
						->searchable()
						->label('Район')
						->required(),
					TextInput::make('head')
						->label('ФИО начальника')
						->minLength(2)
						->maxLength(64)
						->required(),
				]),
				Section::make('Контактные данные')->columns()->schema([
					Textarea::make('address')
						->label('Почтовый адрес')
						->rows(3)
						->columnSpanFull()
						->minLength(2)
						->maxLength(150)
						->required(),
					TableRepeater::make('telephones')
						->relationship()
						->defaultItems(0)
						->disableItemMovement(false)
						->label('Номера телефонов')
						->headers(['Название', 'Номер'])
						->emptyLabel('Нет номеров')
						->createItemButtonLabel('Добавить телефон')
						->orderable()
						->schema([
							TextInput::make('name')
								->placeholder('Стационарный')
								->disableLabel()
								->maxLength(64)
								->required(),
							TextInput::make('number')
								->placeholder('8 (930) 000-00-00')
								->disableLabel()
								->maxLength(32)
								->required(),
						]),
					TextInput::make('email')
						->label('Адрес электронной почты')
						->email()
						->maxLength(64),
				]),
				Section::make('Ссылки')->schema([
					TextInput::make('maintenance_url')
						->label('Обслуживание и эксплуатация')
						->url()
						->maxLength(255),
					TextInput::make('repair_url')
						->label('Ремонт дорог')
						->url()
						->maxLength(255),
					TextInput::make('monitoring_url')
						->label('Интерактивная карта')
						->url()
						->maxLength(255),
					TextInput::make('information_url')
						->label('Информация по содержанию и строительству')
						->url()
						->maxLength(255),
				]),
				Toggle::make('status')
					->inline()
					->label('Статус')
					->columnSpanFull(),
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
				TextColumn::make('administration.name')
					->label('Управление')
					->sortable(),
				ToggleColumn::make('status')
					->label('Статус'),
			])
			->filters([
				Tables\Filters\SelectFilter::make('maintenance_road_administration_id')
					->relationship('administration', 'name')
					->label('Дорожное управление'),
			])
			->actions([
				Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make(),
			])
			->bulkActions([
				Tables\Actions\DeleteBulkAction::make(),
			]);
	}

	public static function getPages(): array
	{
		return [
			'index' => RoadSectionResource\Pages\ListRoadSection::route('/'),
			'create' => RoadSectionResource\Pages\CreateRoadSection::route('/create'),
			'edit' => RoadSectionResource\Pages\EditRoadSection::route('/{record}/edit'),
		];
	}
}
