<?php

namespace App\Events\Maintenance;

use App\Models\MaintenanceQuestion;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuestionCreated
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public function __construct(public MaintenanceQuestion $question)
	{
	}
}
