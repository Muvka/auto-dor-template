<?php

namespace App\Providers;

use App\Events\Maintenance\QuestionCreated;
use App\Events\Maintenance\RoadProblemCreated;
use App\Listeners\Maintenance\NewQuestionEmailNotification;
use App\Listeners\Maintenance\NewRoadProblemEmailNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
	/**
	 * The event to listener mappings for the application.
	 *
	 * @var array<class-string, array<int, class-string>>
	 */
	protected $listen = [
		Registered::class => [
			SendEmailVerificationNotification::class,
		],
		RoadProblemCreated::class => [
			NewRoadProblemEmailNotification::class,
		],
		QuestionCreated::class => [
			NewQuestionEmailNotification::class,
		],
	];

	/**
	 * Register any events for your application.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Determine if events and listeners should be automatically discovered.
	 *
	 * @return bool
	 */
	public function shouldDiscoverEvents()
	{
		return false;
	}
}
