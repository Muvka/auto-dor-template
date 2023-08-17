<?php

namespace App\Http\Controllers\Api\V1\Maintenance;

use App\Http\Controllers\Controller;
use Arr;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
	public function index(string $path = '')
	{
		activity()
			->causedBy(auth('sanctum')->user())
			->log('Экран: Документация'.($path ? ' - '.$path : ''));

		$upDirectory = '';

		if ($path) {
			$upDirectory = [
				'type' => 'directory-up',
				'name' => 'Назад',
				'description' => '',
				'path' => dirname($path) !== '.' ? dirname($path) : '',
			];
		}

		$directoriesRaw = Storage::disk('documents')->directories($path);

		$directories = Arr::map($directoriesRaw, function ($directory) {
			return [
				'type' => 'directory',
				'name' => basename($directory),
				'description' => 'Файлов: '.count(Storage::disk('documents')->allFiles($directory)),
				'path' => $directory,
			];
		});

		$filesRaw = Storage::disk('documents')->files($path);

		$files = Arr::map($filesRaw, function ($file) {
			return [
				'type' => 'file',
				'name' => basename($file),
				'description' => '',
				'path' => $file,
			];
		});

		return response()->json([
			'data' => Arr::collapse([$upDirectory ? [$upDirectory] : [], $directories, $files]),
		], 200);
	}

	public function downloadFile($path)
	{
		abort_if(
			! Storage::disk('documents')->exists($path),
			404,
			'Такого файла не существует.'
		);

		$logMessage = 'Скачал файл: '.basename($path);

		if (request()->path) {
			$logMessage .= ' из директории '.dirname($path);
		}

		activity()
			->causedBy(auth('sanctum')->user())
			->log($logMessage);

		return Storage::disk('documents')->download($path);
	}

	public function destroy(Request $request)
	{
		if ( ! Storage::disk('documents')->exists($request->path)) {
			return response()->json([
				'error' => 'Такого файла не существует.',
			], 404);
		}

		$logMessage = '';

		if (File::isFile(Storage::disk('documents')->path($request->path))) {
			Storage::disk('documents')->delete($request->path);
			$logMessage .= 'Удалил файл: '.basename(request()->path);
		} elseif (File::isDirectory(Storage::disk('documents')->path($request->path))) {
			Storage::disk('documents')->deleteDirectory(request()->path);
			$logMessage .= 'Удалил директорию: '.basename(request()->path);
		}

		if ($request->path && dirname($request->path) !== '.') {
			$logMessage .= ' в директории '.dirname($request->path);
		}

		activity()
			->causedBy(auth('sanctum')->user())
			->log($logMessage);

		return response()->json([
			'message' => 'Файл удален.',
		], 200);
	}
}
