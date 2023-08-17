<?php

namespace App\Http\Requests\Maintenance;

use App\Rules\DirectoryNameRule;
use App\Rules\FileUniqueRule;
use Illuminate\Foundation\Http\FormRequest;
use Str;

class CreateDocumentDirectoryRequest extends FormRequest
{
	protected function prepareForValidation(): void
	{
		$this->merge([
			'name' => Str::replace(' ', '_', $this->name),
		]);
	}

	public function authorize(): bool
	{
		return auth()->check() || auth('sanctum')->check();
	}

	public function rules(): array
	{
		return [
			'name' => [
				'required',
				'max:256',
				new DirectoryNameRule(),
				new FileUniqueRule('documents', request()->path),
			],
		];
	}

	public function attributes(): array
	{
		return [
			'name' => 'Название директории',
		];
	}
}
