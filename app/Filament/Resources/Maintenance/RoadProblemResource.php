<?php

namespace App\Filament\Resources\Maintenance;

use App\Filament\Resources\Maintenance\RoadProblemResource\Widgets\RoadProblemStats;
use App\Filament\Resources\Request\RoadProblemResource\Pages;
use App\Models\MaintenanceRoadProblem;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use stdClass;

class RoadProblemResource extends Resource {
	protected static ?string $model = MaintenanceRoadProblem::class;

	protected static ?string $navigationGroup = 'Запросы';

	protected static ?int $navigationSort = 10;

	protected static ?string $navigationIcon = 'heroicon-o-mail';

	protected static ?string $label = 'Проблема';

	protected static ?string $pluralLabel = 'Проблемы';

	protected static ?string $recordTitleAttribute = 'address';

	public static function form(Form $form): Form {
		return $form
			->schema([
				Card::make()
					->schema([
						TextInput::make('address')
							->label('Адрес')
							->minLength(2)
							->maxLength(150)
							->required(),
						Textarea::make('comment')
							->label('Описание проблемы')
							->minLength(3)
							->maxLength(1000)
							->required()
					]),
				Section::make('Контактные данные')
					->schema([
						TextInput::make('telephone')
							->label('Номер телефона')
							->required()
							->maxLength(32),
					]),
				Section::make('Фотографии')
					->collapsible()
					->schema([
						SpatieMediaLibraryFileUpload::make('image')
							->collection('maintenance-road-problem-images')
							->multiple()
							->imagePreviewHeight(800)
							->maxFiles(10)
							->disableLabel(),
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
				TextColumn::make('address')
					->label('Адрес')
					->sortable(),
				TextColumn::make('created_at')
					->label('Дата заявки')
					->dateTime()
					->sortable(),
			])
			->filters([
				//
			])
			->actions([
				Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make(),
			])
			->bulkActions([
				Tables\Actions\DeleteBulkAction::make(),
			]);
	}

	public static function getPages(): array {
		return [
			'index' => RoadProblemResource\Pages\ListRoadProblem::route('/'),
			'create' => RoadProblemResource\Pages\CreateRoadProblem::route('/create'),
			'edit' => RoadProblemResource\Pages\EditRoadProblem::route('/{record}/edit'),
		];
	}

	public static function getWidgets(): array {
		return [
			RoadProblemStats::class,
		];
	}
}
