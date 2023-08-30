<?php

use App\Http\Controllers\Api\V1\Maintenance\DocumentController;
use App\Http\Controllers\Api\V1\Maintenance\MunicipalAreaController;
use App\Http\Controllers\Api\V1\Maintenance\RoadAdministrationController;
use App\Http\Controllers\Api\V1\Maintenance\RoadSectionController;
use App\Http\Controllers\Api\V1\Maintenance\RoadProblemController;
use App\Http\Controllers\Api\V1\Maintenance\QuestionController;
use App\Http\Controllers\Api\V1\Maintenance\SettingsController as MaintenanceSettingsController;
use App\Http\Controllers\Api\V1\Shared\PrivateFileController;
use App\Http\Controllers\Api\V1\Shared\SettingsController as SharedSettingsController;
use App\Http\Controllers\Api\V1\User\ActivityController;
use App\Http\Controllers\Api\V1\User\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('files/private/download/{file}', [PrivateFileController::class, 'download'])
	->middleware('auth:sanctum');

Route::prefix('user')->group(function () {
	Route::post('login', [AuthController::class, 'login']);
	Route::delete('logout', [AuthController::class, 'logout']);
	Route::post('activity', [ActivityController::class, 'store'])->middleware('auth:sanctum');
});

Route::prefix('maintenance')
	->group(function () {
		Route::get('settings', MaintenanceSettingsController::class);
		Route::get('municipal-areas', [MunicipalAreaController::class, 'index']);
		Route::get('road-administrations', [RoadAdministrationController::class, 'index']);
		Route::get('road-sections', [RoadSectionController::class, 'index']);

		Route::post('road-problems', [RoadProblemController::class, 'store']);
		Route::post('questions', [QuestionController::class, 'store']);

		Route::middleware('auth:sanctum')->group(function () {
			Route::get('documents/download/{path}', [DocumentController::class, 'downloadFile'])
				->where('path', '(.*)');
			Route::get('documents/root/{path?}', [DocumentController::class, 'index'])
				->where('path', '(.*)');
			Route::delete('documents/root/{path?}', [DocumentController::class, 'destroy'])
				->where('path', '(.*)');
		});
	});

Route::prefix('shared')
	->group(function () {
		Route::get('settings', SharedSettingsController::class);
	});
