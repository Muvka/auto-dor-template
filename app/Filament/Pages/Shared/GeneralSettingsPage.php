<?php

namespace App\Filament\Pages\Shared;

use App\Settings\Shared\GeneralSettings;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage as BaseSettingsPage;

class GeneralSettingsPage extends BaseSettingsPage
{
	protected static ?string $navigationGroup = 'Общее';

	protected static ?int $navigationSort = 10;

	protected static ?string $navigationIcon = 'heroicon-o-cog';

	protected static ?string $slug = 'shared-general-settings';

	protected static ?string $title = 'Основные настройки';

	protected static string $settings = GeneralSettings::class;

	protected function getFormSchema(): array
	{
		return [
			Tabs::make('Настройки')
				->columnSpanFull()
				->tabs([
					Tabs\Tab::make('Информация')
						->schema([
							TextInput::make('information_slogan_text')
								->label('Слоган'),
							RichEditor::make('information_privacy_text')
								->toolbarButtons([
									'bold',
									'bulletList',
									'orderedList'
								])
								->label('Политика конфиденциальности')
						]),
					Tabs\Tab::make('Контактные данные')
						->schema([
							TextInput::make('contact_telephone_number')
								->label('Номер телефона')
								->required(),
							TextInput::make('contact_vkontakte_url')
								->label('Ссылка на Вконтакте')
								->url(),
							TextInput::make('contact_telegram_url')
								->label('Ссылка на Telegram')
								->url(),
						]),
					Tabs\Tab::make('Приложения')
						->schema([
							TextInput::make('application_app_store_url')
								->label('Ссылка на приложение в App Store')
								->url(),
							TextInput::make('application_google_play_url')
								->label('Ссылка на приложение в Google Play')
								->url(),
						])
				])
		];
	}
}
