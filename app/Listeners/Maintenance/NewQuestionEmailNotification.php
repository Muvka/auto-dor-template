<?php

namespace App\Listeners\Maintenance;

use App\Events\Maintenance\QuestionCreated;
use App\Mail\Maintenance\QuestionShipped;
use App\Settings\Maintenance\GeneralSettings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NewQuestionEmailNotification
{
    public function handle(QuestionCreated $event): void
    {
		$settings = app(GeneralSettings::class);

		$email = $settings->contact_email_address;

		if (!$email) return;

		Mail::to($email)
			->send(new QuestionShipped($event->question));
    }
}
