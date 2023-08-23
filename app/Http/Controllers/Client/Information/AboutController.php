<?php

namespace App\Http\Controllers\Client\Information;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class AboutController extends Controller
{
	public function __invoke()
	{
		return Inertia::render('Information/AboutPage', [
			'title' => 'О компании',
			'description' => 'Наша компания предлагает широкий спектр услуг:',
			'services' => [
				[
					'id' => 'construction-works',
					'icon' => asset('assets/client/images/information/service-list/work-in-progress.svg'),
					'text' => 'Выполнение работ по строительству, реконструкции, капитальному ремонту, ремонту автодорог',
				],
				[
					'id' => 'maintenance-works',
					'icon' => asset('assets/client/images/information/service-list/road.svg'),
					'text' => 'Выполнение работ по ремонту и содержанию автодорог',
				],
				[
					'id' => 'laboratory',
					'icon' => asset('assets/client/images/information/service-list/laboratory.svg'),
					'text' => 'Лабораторный контроль качества выпускаемой продукции',
				],
				[
					'id' => 'production',
					'icon' => asset('assets/client/images/information/service-list/stones.svg'),
					'text' => 'Производство асфальтобетонных смесей всех типов и видов',
				],
				[
					'id' => 'tow-truck',
					'icon' => asset('assets/client/images/information/service-list/tow-truck.svg'),
					'text' => 'Услуги эвакуаторов и хранение транспортных средств',
				],
				[
					'id' => 'rent',
					'icon' => asset('assets/client/images/information/service-list/bulldozer.svg'),
					'text' => 'Аренда спецтехники',
				],
			],
		]);
	}
}
