<?php

namespace App\Http\Requests\Maintenance;

use App\Rules\FileUniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class UploadDocumentRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return auth()->check() || auth('sanctum')->check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
	 */
	public function rules(): array
	{
		return [
			'documents' => 'required|array|max:5',
			'documents.*' => [
				'file',
				'max:20480',
				'mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,text/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				new FileUniqueRule('documents', request()->path),
			],
		];
	}

	public function attributes(): array
	{
		return [
			'documents' => 'Документы',
			'documents.*' => 'Документ',
		];
	}

	public function messages()
	{
		return [
			'documents.*.max' => 'Один или несколько файлов превышают допустимый размер 20мб',
			'documents.*.mimetypes' => 'Один или несколько файлов имеют недопустимый формат',
		];
	}
}
