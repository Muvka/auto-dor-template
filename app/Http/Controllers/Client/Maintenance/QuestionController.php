<?php

namespace App\Http\Controllers\Client\Maintenance;

use App\Events\Maintenance\QuestionCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Maintenance\StoreQuestionRequest;
use App\Models\MaintenanceQuestion;
use Inertia\Inertia;

class QuestionController extends Controller
{
	public function create()
	{
		return Inertia::render('Maintenance/QuestionFormPage', [
			'title' => 'Задать вопрос',
			'subjects' => [
				'Строительство дорог',
				'Ремонт и содержание дорог',
				'Производство дорожных материалов',
				'Аренда спецтехники',
				'Услуги эвакуаторов',
			]
		]);
	}

	public function store(StoreQuestionRequest $request) {
		$validated = $request->validated();
		$question = MaintenanceQuestion::create($validated);

		if ($request->images) {
			foreach ($request->images as $image) {
				$question->addMedia($image)
					->toMediaCollection('maintenance-question-images');
			}
		}

		event(new QuestionCreated($question));

		return back();
	}
}
