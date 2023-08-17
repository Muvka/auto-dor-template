<?php

namespace App\Filament\Pages\Maintenance;

use App\Settings\Maintenance\GeneralSettings;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage as BaseSettingsPage;

class GeneralSettingsPage extends BaseSettingsPage
{
	protected static ?string $navigationGroup = 'Обслуживание';

	protected static ?int $navigationSort = 40;

	protected static ?string $navigationIcon = 'heroicon-o-cog';

	protected static ?string $slug = 'maintenance-general-settings';

	protected static ?string $title = 'Настройки';

	protected static string $settings = GeneralSettings::class;

	protected function getFormSchema(): array
	{
		return [
			Section::make('Контактные данные')
				->columns()
				->schema([
					TextInput::make('contact_service_telephone_number')
						->label('Единый номер круглосуточной диспетчерской службы')
						->required(),
					TextInput::make('contact_dispatcher_telephone_number')
						->label('Единый номер автодиспетчера')
						->required(),
					TextInput::make('contact_email_address')
						->label('Адрес электронной почты')
						->columnSpanFull()
						->email()
						->required(),
				]),
			Section::make('Ссылки')
				->columns()
				->schema([
					TextInput::make('area_weather_url')
						->label('Погода')
						->columnSpanFull()
						->url(),
				]),
		];
	}
}
