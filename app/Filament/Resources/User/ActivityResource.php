<?php

namespace App\Filament\Resources\User;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Resources\User\ActivityResource\Pages;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Spatie\Activitylog\Models\Activity;
use stdClass;

class ActivityResource extends Resource
{
	protected static ?string $model = Activity::class;

	protected static ?string $navigationGroup = 'Пользователи';

	protected static ?int $navigationSort = 20;

	protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

	protected static ?string $label = 'Активность';

	protected static ?string $pluralLabel = 'Активности';

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Card::make()->columns(3)->schema([
					Select::make('causer_id')
						->relationship('causer', 'name')
						->label('Пользователь'),
					TextInput::make('description')
						->label('Действие'),
					DateTimePicker::make('created_at')
						->label('Дата'),
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
				TextColumn::make('causer.name')
					->label('Пользователь')
					->searchable()
					->sortable(),
				TextColumn::make('description')
					->label('Действие')
					->searchable()
					->wrap()
					->sortable(),
				TextColumn::make('created_at')
					->label('Дата')
					->dateTime()
					->sortable(),
			])
			->actions([
				Tables\Actions\ViewAction::make(),
			])
			->bulkActions([
				FilamentExportBulkAction::make('export')
					->label('Экспорт в xml'),
			]);
	}

	public static function getRelations(): array
	{
		return [
			//
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ListActivities::route('/'),
			'view' => Pages\ViewActivity::route('/{record}'),
		];
	}
}
