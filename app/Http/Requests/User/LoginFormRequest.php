<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
{
	public function authorize(): bool
	{
		return auth()->guest();
	}

	public function rules(): array
	{
		return [
			'email' => ['string', 'required', 'email'],
			'password' => ['required', 'string']
		];
	}
}
