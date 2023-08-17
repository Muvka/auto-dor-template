<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProblemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
		return [
			'address' => 'required|min:2|max:150',
			'comment' => 'required|min:3|max:1000',
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
			'address' => 'Адрес',
			'comment' => 'Комментарий',
			'telephone' => 'Номер телефона',
		];
	}
}
