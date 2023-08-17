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
			'description' => fake()->realText('300'),
			'services' => [
				[
					'id' => 'construction-works',
					'icon' => asset('assets/client/images/information/service-list/work-in-progress.svg'),
					'text' => fake()->realTextBetween('50', '200'),
				],
				[
					'id' => 'maintenance-works',
					'icon' => asset('assets/client/images/information/service-list/road.svg'),
					'text' => fake()->realTextBetween('50', '200'),
				],
				[
					'id' => 'laboratory',
					'icon' => asset('assets/client/images/information/service-list/laboratory.svg'),
					'text' => fake()->realTextBetween('50', '200'),
				],
				[
					'id' => 'production',
					'icon' => asset('assets/client/images/information/service-list/stones.svg'),
					'text' => fake()->realTextBetween('50', '200'),
				],
				[
					'id' => 'tow-truck',
					'icon' => asset('assets/client/images/information/service-list/tow-truck.svg'),
					'text' => fake()->realTextBetween('50', '200'),
				],
				[
					'id' => 'rent',
					'icon' => asset('assets/client/images/information/service-list/bulldozer.svg'),
					'text' => fake()->realTextBetween('50', '200'),
				],
			],
		]);
	}
}
