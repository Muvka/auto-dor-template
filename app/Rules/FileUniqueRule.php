<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Storage;

class FileUniqueRule implements ValidationRule
{
	public function __construct(private $disk = 'local', private $path = '')
	{
	}

	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		$isFile = \File::isFile($value);
		$fileName = $isFile ? $value->getClientOriginalName() : $value;

		if (Storage::disk($this->disk)->exists($this->path.'/'.$fileName)) {
			if ($isFile) {
				$fail('Файл с именем "'.$value->getClientOriginalName().'" уже существует');
			} else {
				$fail('":attribute" с таким именем уже существует');
			}
		}
	}
}
