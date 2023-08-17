<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginFormRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class AuthController extends Controller
{
	public function login(LoginFormRequest $request)
	{
		if ( ! auth()->attempt($request->validated())) {
			return response()->json([
				'message' => 'Пользователь не найден, либо данные введены не верно',
			], 401);
		}

		$user = User::where('email', $request->email)->first();

		return response()->json([
			'message' => 'Вы авторизованы',
			'data' => [
				'token' => $user->createToken("api-token")->plainTextToken,
				'user' => new UserResource($user),
			],
		], 200);
	}

	public function logout()
	{
		if (auth('sanctum')->check()) {
			auth('sanctum')
				->user()
				->currentAccessToken()
				->delete();
		}

		return response()->json([
			'message' => 'Вы вышли из аккаунта',
		], 200);
	}
}
