<?php

namespace App\Http\Requests\Maintenance;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
	public function authorize(): bool
	{
		return true;
	}

	public function rules(): array
	{
		return [
			'subject' => 'required|min:2|max:64',
			'text' => 'required|min:3|max:1000',
			'telephone' => 'required|max:32',
		];
	}

	public function attributes(): array
	{
		return [
			'subject' => 'Тема обращения',
			'text' => 'Ваш вопрос',
			'telephone' => 'Номер телефона',
		];
	}
}
