<?php

namespace App\Filament\Resources\Maintenance;

use App\Filament\Resources\Request\QuestionResource\Pages;
use App\Models\MaintenanceQuestion;
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

class QuestionResource extends Resource
{
    protected static ?string $model = MaintenanceQuestion::class;

	protected static ?string $navigationGroup = 'Запросы';

	protected static ?int $navigationSort = 20;

    protected static ?string $navigationIcon = 'heroicon-o-mail';

	protected static ?string $label = 'Вопрос';

	protected static ?string $pluralLabel = 'Вопросы';

	protected static ?string $recordTitleAttribute = 'subject';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
				Card::make()
					->schema([
						TextInput::make('subject')
							->label('Тема обращения')
							->minLength(2)
							->maxLength(64)
							->required(),
						Textarea::make('text')
							->label('Текст вопроса')
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
							->collection('maintenance-question-images')
							->multiple()
							->imagePreviewHeight(800)
							->maxFiles(10)
							->disableLabel(),
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
				TextColumn::make('subject')
					->label('Тема обращения')
					->sortable(),
				TextColumn::make('created_at')
					->label('Дата заявки')
					->dateTime()
					->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => \App\Filament\Resources\Maintenance\QuestionResource\Pages\ListQuestions::route('/'),
            'create' => \App\Filament\Resources\Maintenance\QuestionResource\Pages\CreateQuestion::route('/create'),
            'edit' => \App\Filament\Resources\Maintenance\QuestionResource\Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
