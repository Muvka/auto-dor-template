<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function store(Request $request) {
		if (!auth('sanctum')->check()) {
			return response()->json([
				'error' => 'Доступ запрещен',
			], 403);
		}

		activity()
			->causedBy(auth('sanctum')->user())
			->log($request->message);

		return response()->json([
			'message' => 'Действие успешно сохранено',
		], 200);
	}
}
