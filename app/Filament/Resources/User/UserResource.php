<?php

namespace App\Filament\Resources\User;

use App\Filament\Resources\User\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use stdClass;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

	protected static ?string $navigationGroup = 'Пользователи';

	protected static ?int $navigationSort = 10;

    protected static ?string $navigationIcon = 'heroicon-o-users';

	protected static ?string $label = 'Пользователь';

	protected static ?string $pluralLabel = 'Пользователи';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
				Card::make()->columns(3)->schema([
					TextInput::make('name')
						->label('Имя')
						->minLength(2)
						->maxLength(255)
						->required(),
					TextInput::make('password')
						->label('Пароль')
						->password()
						->dehydrateStateUsing(fn ($state) => Hash::make($state))
						->dehydrated(fn ($state) => filled($state))
						->required(fn (string $context): bool => $context === 'create'),
					TextInput::make('email')
						->label('Адрес электронной почты')
						->email()
						->required()
						->unique(ignoreRecord: true)
						->maxLength(255),
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
					->label('Имя')
					->sortable(),
				TextColumn::make('email')
					->label('Адрес электронной почты'),
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

	public static function getEloquentQuery(): Builder
	{
		return parent::getEloquentQuery()
			->where('is_admin', 0);
	}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
