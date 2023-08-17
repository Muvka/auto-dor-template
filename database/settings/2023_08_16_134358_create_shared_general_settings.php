<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
	public function up(): void
	{
		$this->migrator->add('shared_general.information_slogan_text', '');
		$this->migrator->add('shared_general.information_privacy_text', '');

		$this->migrator->add('shared_general.contact_telephone_number', '');
		$this->migrator->add('shared_general.contact_vkontakte_url', '');
		$this->migrator->add('shared_general.contact_telegram_url', '');

		$this->migrator->add('shared_general.application_app_store_url', '');
		$this->migrator->add('shared_general.application_google_play_url', '');
	}

	public function down(): void
	{
		$this->migrator->delete('shared_general.information_slogan_text');
		$this->migrator->delete('shared_general.information_privacy_text');

		$this->migrator->delete('shared_general.contact_telephone_number');
		$this->migrator->delete('shared_general.contact_vkontakte_url');
		$this->migrator->delete('shared_general.contact_telegram_url');

		$this->migrator->delete('shared_general.application_app_store_url');
		$this->migrator->delete('shared_general.application_google_play_url');
	}
};
