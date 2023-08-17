<?php

namespace App\Http\Controllers\Client\Maintenance;

use App\Events\Maintenance\RoadProblemCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Maintenance\StoreRoadProblemRequest;
use App\Models\MaintenanceRoadProblem;
use Inertia\Inertia;

class RoadProblemController extends Controller
{
	public function create() {
		return Inertia::render('Maintenance/RoadProblemFormPage', [
			'title' => 'Фиксация замечаний к дорогам',
		]);
	}

	public function store(StoreRoadProblemRequest $request) {
		$validated = $request->validated();
		$roadProblem = MaintenanceRoadProblem::create($validated);

		if ($request->images) {
			foreach ($request->images as $image) {
				$roadProblem->addMedia($image)
					->toMediaCollection('maintenance-road-problem-images');
			}
		}

		event(new RoadProblemCreated($roadProblem));

		return back();
	}
}
