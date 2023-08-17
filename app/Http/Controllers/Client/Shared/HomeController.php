<?php

namespace App\Http\Controllers\Client\Shared;

use App\Http\Controllers\Controller;
use App\Settings\Shared\GeneralSettings;
use Inertia\Inertia;

class HomeController extends Controller
{
	public function __invoke(GeneralSettings $settings)
	{
		$contacts = [];

		if ($settings->contact_vkontakte_url) {
			$contacts[] = [
				'id' => 'vkontakte',
				'label' => 'Вконтакте',
				'icon' => 'vkontakte',
				'url' => $settings->contact_vkontakte_url,
				'target' => '_blank'
			];
		}

		if ($settings->contact_telegram_url) {
			$contacts[] = [
				'id' => 'telegram',
				'label' => 'Телеграм',
				'icon' => 'telegram',
				'url' => $settings->contact_telegram_url,
				'target' => '_blank'
			];
		}

		if ($settings->contact_telephone_number) {
			$contacts[] = [
				'id' => 'call',
				'label' => 'Позвонить нам',
				'url' => sprintf('tel:%s', preg_replace('/[^0-9+]/', '', $settings->contact_telephone_number)),
				'icon' => 'calling',
			];
		}

		return Inertia::render('Shared/HomePage', [
			'title' => 'Главная страница',
			'siteSections' => $this->getSiteSections(),
			'contacts' => $contacts
		]);
	}

	private function getSiteSections(): array
	{
		return [
			[
				'id' => 'maintenance',
				'title' => 'Обслуживание и&nbsp;эксплуатация дорог',
				'url' => route('client.maintenance.maintenance.municipal_areas.index'),
			],
			[
				'id' => 'repair',
				'title' => 'Ремонт, строительство дорог',
				'url' => route('client.maintenance.repair.municipal_areas.index'),
			],
			[
				'id' => 'fixing-comments',
				'title' => 'Фиксация замечаний к&nbsp;дорогам',
				'url' => route('client.maintenance.road_problem.create'),
			],
			[
				'id' => 'about',
				'title' => 'О&nbsp;компании',
				'url' => route('client.information.about'),
			],
		];
	}
}
