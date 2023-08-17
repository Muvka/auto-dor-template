<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		Filament::serving(function () {
			Filament::registerNavigationGroups([
				NavigationGroup::make()
					->label('Обслуживание')
					->collapsed(),
				NavigationGroup::make()
					->label('Запросы')
					->collapsed(),
				NavigationGroup::make()
					->label('Пользователи')
					->collapsed(),
				NavigationGroup::make()
					->label('Общее')
					->collapsed(),
			]);
		});
    }
}
