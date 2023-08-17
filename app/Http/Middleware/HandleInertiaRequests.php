<?php

namespace App\Http\Middleware;

use App\Settings\Shared\GeneralSettings;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
	protected $rootView = 'app';

	public function version(Request $request): ?string
	{
		return parent::version($request);
	}

	public function share(Request $request): array
	{
		$settings = app(GeneralSettings::class);

		return array_merge(parent::share($request), [
			'shared.user' => fn(Request $request) => $request->user() ? $request->user()
				->only('name') : null,
			'shared.app' => [
				'name' => config('app.name'),
				'slogan' => $settings->information_slogan_text,
			],
			'shared.applications' => $this->getApplications(),
		]);
	}


	private function getApplications(): array
	{
		$settings = app(GeneralSettings::class);

		$applications = [];

		if ($settings->application_app_store_url) {
			$applications[] = [
				'id' => 'app-store',
				'label' => 'App Store',
				'url' => $settings->application_app_store_url,
				'image' => asset('assets/client/images/applications/app-store.svg'),
			];
		}

		if ($settings->application_google_play_url) {
			$applications[] = [
				'id' => 'google-play',
				'label' => 'Google Play',
				'url' => $settings->application_google_play_url,
				'image' => asset('assets/client/images/applications/google-play.svg'),
			];
		}

		return $applications;
	}
}
