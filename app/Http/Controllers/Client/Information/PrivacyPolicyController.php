<?php

namespace App\Http\Controllers\Client\Information;

use App\Http\Controllers\Controller;
use App\Settings\Shared\GeneralSettings;
use Inertia\Inertia;

class PrivacyPolicyController extends Controller
{
	public function __invoke(GeneralSettings $settings)
	{
		if (!$settings->information_privacy_text) {
			abort(404);
		}

		return Inertia::render('Information/PrivacyPolicyPage', [
			'title' => 'Политика конфиденциальности',
			'text' => $settings->information_privacy_text
		]);
	}
}
