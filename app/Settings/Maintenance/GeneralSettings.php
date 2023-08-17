<?php
namespace App\Settings\Maintenance;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
	public string $contact_service_telephone_number;

	public string $contact_dispatcher_telephone_number;

	public string $contact_email_address;

	public string $area_weather_url;

	public static function group(): string
	{
		return 'maintenance_general';
	}
}
