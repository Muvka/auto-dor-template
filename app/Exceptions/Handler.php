<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
	/**
	 * A list of exception types with their corresponding custom log levels.
	 *
	 * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
	 */
	protected $levels = [
		//
	];

	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array<int, class-string<\Throwable>>
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed to the session on validation exceptions.
	 *
	 * @var array<int, string>
	 */
	protected $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];

	/**
	 * Register the exception handling callbacks for the application.
	 *
	 * @return void
	 */
	public function register(): void
	{
		$this->reportable(function (Request $request) {

		});
	}

	public function render($request, Throwable $e): JsonResponse|Response
	{
		$response = parent::render($request, $e);

		if (in_array($response->status(), [500, 503, 404, 403])) { //! app()->environment(['local', 'testing']) &&
			return Inertia::render('Shared/ErrorPage', [
				'status' => $response->status(),
				'title' => 'Ошибка '.$response->status(),
				'description' => [
					403 => "Извините! Вам запрещен доступ к этой странице.",
					404 => "Извините! Страница, которую Вы ищете не существует.",
					500 => "Упс, что-то пошло не так на наших серверах.",
					503 => "Извините! Мы проводим техническое обслуживание.",
				][$response->status()],
			])
				->toResponse($request)
				->setStatusCode($response->status());
		} elseif ($response->status() === 419) {
			return back()->with([
				'message' => 'Срок действия страницы истек, пожалуйста, попробуйте еще раз.',
			]);
		}

		return $response;
	}
}
