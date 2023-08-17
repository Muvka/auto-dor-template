<?php

use App\Http\Controllers\Client\Information\AboutController;
use App\Http\Controllers\Client\Information\PrivacyPolicyController;
use App\Http\Controllers\Client\Maintenance\CentralOfficeController;
use App\Http\Controllers\Client\Maintenance\ClosedSectionController;
use App\Http\Controllers\Client\Maintenance\DocumentController;
use App\Http\Controllers\Client\Maintenance\MaintenanceMunicipalAreaController;
use App\Http\Controllers\Client\Maintenance\MonitoringMunicipalAreaController;
use App\Http\Controllers\Client\Maintenance\QuestionController;
use App\Http\Controllers\Client\Maintenance\RepairMunicipalAreaController;
use App\Http\Controllers\Client\Maintenance\RoadAdministrationController;
use App\Http\Controllers\Client\Maintenance\RoadProblemController;
use App\Http\Controllers\Client\Shared\HomeController;
use App\Http\Controllers\Client\Shared\PrivateFileController;
use App\Http\Controllers\Client\User\AuthController;
use App\Models\MaintenanceMunicipalArea;
use App\Models\MaintenanceRoadAdministration;
use Illuminate\Support\Facades\Route;

Route::name('client.')
	->group(function () {
		Route::get('/', HomeController::class)
			->name('shared.home')
			->breadcrumb('Главная');
		Route::get('about', AboutController::class)
			->name('information.about')
			->breadcrumb('О компании', 'client.shared.home');
		Route::get('privacy', PrivacyPolicyController::class)
			->name('information.privacy')
			->breadcrumb('Политика конфиденциальности', 'client.shared.home');
		Route::get('files/private/download/{file}', [PrivateFileController::class, 'download'])
			->middleware('auth')
			->name('shared.files.private.download');

		Route::controller(AuthController::class)
			->name('user.auth.')
			->group(function () {
				Route::get('login', 'loginForm')
					->name('login_form')
					->middleware('guest');
				Route::post('login', 'login')
					->name('login')
					->middleware('guest');
				Route::delete('logout', 'logout')
					->name('logout')
					->middleware('auth');
			});


		Route::name('maintenance.')
			->group(function () {
				Route::get('maintenance/municipal-areas', [MaintenanceMunicipalAreaController::class, 'index'])
					->name('maintenance.municipal_areas.index')
					->breadcrumb('Обслуживание и эксплуатация дорог', 'client.shared.home');
				Route::get('maintenance/municipal-areas/{id}', [MaintenanceMunicipalAreaController::class, 'show'])
					->name('maintenance.municipal_areas.show')
					->breadcrumb(
						fn(string $id) => MaintenanceMunicipalArea::select('id', 'name')
								->findOrFail($id)->name.' район',
						'client.maintenance.maintenance.municipal_areas.index'
					);

				Route::get('repair/municipal-areas', [RepairMunicipalAreaController::class, 'index'])
					->name('repair.municipal_areas.index')
					->breadcrumb('Ремонт, строительство дорог', 'client.shared.home');
				Route::get('repair/municipal-areas/{id}', [RepairMunicipalAreaController::class, 'show'])
					->name('repair.municipal_areas.show')
					->breadcrumb(
						fn(string $id) => MaintenanceMunicipalArea::select('id', 'name')
								->findOrFail($id)->name.' район',
						'client.maintenance.repair.municipal_areas.index'
					);

				Route::prefix('closed')
					->middleware('auth')
					->group(function () {
						Route::get('/', ClosedSectionController::class)
							->name('closed_section')
							->breadcrumb('Закрытый раздел', 'client.shared.home');
						Route::get('central-office', CentralOfficeController::class)
							->name('central_office')
							->breadcrumb('Центральный аппарат', 'client.maintenance.closed_section');
						Route::get('road-administrations', [RoadAdministrationController::class, 'index'])
							->name('road_administrations.index')
							->breadcrumb('Дорожные управления', 'client.maintenance.closed_section');
						Route::get('road-administrations/{id}', [RoadAdministrationController::class, 'show'])
							->name('road_administrations.show')
							->breadcrumb(
								fn(string $id) => MaintenanceRoadAdministration::select('id', 'name')
									->findOrFail($id)->name,
								'client.maintenance.road_administrations.index'
							);
						Route::get('monitoring/municipal-areas', [MonitoringMunicipalAreaController::class, 'index'])
							->name('monitoring.municipal_areas.index')
							->breadcrumb('Мониторинг дорожной техники', 'client.maintenance.closed_section');
						Route::get('monitoring/municipal-areas/{id}', [MonitoringMunicipalAreaController::class, 'show'])
							->name('monitoring.municipal_areas.show')
							->breadcrumb(
								fn(string $id) => MaintenanceMunicipalArea::select('id', 'name')
										->findOrFail($id)->name.' район',
								'client.maintenance.monitoring.municipal_areas.index'
							);

						Route::prefix('documents')
							->controller(DocumentController::class)
							->name('documents.')
							->group(function () {
								Route::get('root', 'index')
									->name('index')
									->breadcrumb('Документы', 'client.maintenance.closed_section');
								Route::get('root/{path}', 'view')
									->where('path', '.*')
									->name('view')
									->breadcrumb(fn() => 'Директория - '.request()->path, 'client.maintenance.documents.index');
								Route::post('root/{path?}', 'store')
									->where('path', '.*')
									->name('store');
								Route::delete('root/{path?}', 'destroy')
									->where('path', '.*')
									->name('destroy');
								Route::post('upload/{path?}', 'upload')
									->where('path', '.*')
									->name('upload');
								Route::get('download/{path}', 'download')
									->where('path', '.*')
									->name('download');
							});
					});

				Route::get('road-problem', [RoadProblemController::class, 'create'])
					->name('road_problem.create')
					->breadcrumb('Фиксация замечаний к дорогам', 'client.shared.home');
				Route::post('road-problem', [RoadProblemController::class, 'store'])
					->name('road_problem.store');

				Route::get('question', [QuestionController::class, 'create'])
					->name('question.create')
					->breadcrumb('Задать вопрос', 'client.shared.home');
				Route::post('question', [QuestionController::class, 'store'])
					->name('question.store');
			});
	});
