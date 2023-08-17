<?php

namespace App\Events\Maintenance;

use App\Models\MaintenanceRoadProblem;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RoadProblemCreated
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public function __construct(public MaintenanceRoadProblem $roadProblem)
	{
	}
}
