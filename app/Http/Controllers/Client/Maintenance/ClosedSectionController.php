<?php

namespace App\Http\Controllers\Client\Maintenance;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ClosedSectionController extends Controller
{
	public function __invoke()
	{
		$title = 'Закрытый раздел';
		activity()
			->log('Страница: '.$title);

		return Inertia::render('Maintenance/ClosedSectionPage', [
			'title' => $title,
			'sections' => $this->getClosedSections(),
		]);
	}

	private function getClosedSections(): array
	{
		return [
			[
				'id' => 'central-office',
				'title' => 'Центральный аппарат',
				'url' => route('client.maintenance.central_office'),
			],
			[
				'id' => 'administration',
				'title' => 'Дорожные управления',
				'url' => route('client.maintenance.road_administrations.index'),
			],
			[
				'id' => 'monitoring',
				'title' => 'Мониторинг дорожной техники',
				'url' => route('client.maintenance.monitoring.municipal_areas.index'),
			],
			[
				'id' => 'documents',
				'title' => 'Документация',
				'url' => route('client.maintenance.documents.index'), // maintenance??
			],
		];
	}
}
