<?php

namespace App\Listeners\Maintenance;

use App\Events\Maintenance\RoadProblemCreated;
use App\Mail\Maintenance\RoadProblemShipped;
use App\Settings\Maintenance\GeneralSettings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NewRoadProblemEmailNotification
{
    public function handle(RoadProblemCreated $event): void
    {
		$settings = app(GeneralSettings::class);

		$email = $settings->contact_email_address;

		if (!$email) return;

		Mail::to($email)
			->send(new RoadProblemShipped($event->roadProblem));
    }
}
