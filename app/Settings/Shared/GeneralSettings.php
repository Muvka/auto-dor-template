<?php

namespace App\Settings\Shared;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
	public ?string $information_slogan_text;

	public ?string $information_privacy_text;

	public string $contact_telephone_number;

	public ?string $contact_vkontakte_url;

	public ?string $contact_telegram_url;

	public ?string $application_app_store_url;

	public ?string $application_google_play_url;

	public static function group(): string
	{
		return 'shared_general';
	}
}
