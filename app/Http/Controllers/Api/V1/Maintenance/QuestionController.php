<?php

namespace App\Http\Controllers\Api\V1\Maintenance;

use App\Events\Maintenance\QuestionCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Maintenance\StoreQuestionRequest;
use App\Models\MaintenanceQuestion;

class QuestionController extends Controller
{
	public function store(StoreQuestionRequest $request)
	{
		$validated = $request->validated();
		$question = MaintenanceQuestion::create($validated);

		if ($request->images) {
			foreach ($request->images as $image) {
				$question->addMedia($image)
					->toMediaCollection('maintenance-question-images');
			}
		}

		event(new QuestionCreated($question));

		return response()->json([
			'message' => 'Вопрос успешно отправлен',
		]);
	}
}
