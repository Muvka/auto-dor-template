<?php

namespace App\Http\Controllers\Api\V1\Shared;

use App\Http\Controllers\Controller;
use App\Settings\Shared\GeneralSettings;

class SettingsController extends Controller
{
	public function __invoke(GeneralSettings $settings): \Illuminate\Http\JsonResponse
	{
		$application = [
			'name' => config('app.name'),
			'slogan' => $settings->information_slogan_text,
		];

		$contacts = [
			'telephone' => $settings->contact_telephone_number ?? '',
			'telegram' => $settings->contact_telegram_url ?? '',
			'vkontakte' => $settings->contact_vkontakte_url ?? ''
		];

		return response()->json([
			'data' => [
				'application' => $application,
				'contacts' => $contacts
			],
		], 200);
	}
}
