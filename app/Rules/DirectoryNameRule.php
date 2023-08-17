<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DirectoryNameRule implements ValidationRule
{
	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		if (!preg_match("/^[a-zA-Z0-9\-\p{Cyrillic}_]+$/u", $value)) {
			$fail('":attribute" должно содержать только буквы, цифры и _"');
		}
	}
}
