<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
		$this->migrator->add('maintenance_general.contact_service_telephone_number', '8(8000)00-00-00');
		$this->migrator->add('maintenance_general.contact_dispatcher_telephone_number', '89300000000');
		$this->migrator->add('maintenance_general.contact_email_address', 'vopros@localhost.ru');
		$this->migrator->add('maintenance_general.area_weather_url', 'https://yandex.ru/pogoda/');
    }

	public function down(): void
	{
		$this->migrator->delete('maintenance_general.contact_service_telephone_number');
		$this->migrator->delete('maintenance_general.contact_dispatcher_telephone_number');
		$this->migrator->delete('maintenance_general.contact_email_address');
		$this->migrator->delete('maintenance_general.area_weather_url');
	}
};
