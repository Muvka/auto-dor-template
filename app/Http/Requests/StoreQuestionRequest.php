<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreQuestionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subject' => 'required|min:2|max:64',
            'text' => 'required|min:3|max:1000',
            'telephone' => 'required|max:32',
        ];
    }

	public function failedValidation(Validator $validator)
	{
		throw new HttpResponseException(response()->json([
			'success'   => false,
			'message'   => 'Ошибки валидации',
			'data'      => $validator->errors()
		]));
	}

	public function attributes() {
		return [
			'subject' => 'Тема обращения',
			'text' => 'Ваш вопрос',
			'telephone' => 'Номер телефона',
		];
	}
}
