<?php

namespace App\Http\Controllers\Client\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginFormRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class AuthController extends Controller
{
	public function loginForm()
	{
		return Inertia::render('User/LoginPage', [
			'title' => 'Авторизация',
		]);
	}

	public function login(LoginFormRequest $request): RedirectResponse
	{
		if ( ! auth()->attempt($request->validated())) {
			return redirect()
				->route('client.user.auth.login')
				->withErrors(['email' => 'Пользователь не найден, либо данные введены не верно']);
		}

		return redirect()->route('client.maintenance.closed_section');
	}

	public function logout(): RedirectResponse
	{
		auth()->logout();

		request()->session()->invalidate();

		request()->session()->regenerateToken();

		return redirect()->route('client.shared.home');
	}
}
