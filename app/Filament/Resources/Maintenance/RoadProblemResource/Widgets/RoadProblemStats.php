<?php

namespace App\Filament\Resources\Maintenance\RoadProblemResource\Widgets;

use App\Models\MaintenanceRoadProblem;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class RoadProblemStats extends BaseWidget
{
	protected function getCards(): array
	{
		return [
			Card::make('Всего заявок', MaintenanceRoadProblem::count()),
			Card::make('Заявок в этом году', MaintenanceRoadProblem::whereYear('created_at', date('Y'))
				->count()),
			Card::make('Заявок в этом месяце', MaintenanceRoadProblem::whereYear('created_at', date('Y'))
				->whereMonth('created_at', date('m'))
				->count()),
		];
	}
}
