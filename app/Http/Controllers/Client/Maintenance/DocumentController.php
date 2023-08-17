<?php

namespace App\Http\Controllers\Client\Maintenance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Maintenance\CreateDocumentDirectoryRequest;
use App\Http\Requests\Maintenance\UploadDocumentRequest;
use Arr;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Str;

class DocumentController extends Controller
{
	public function index()
	{
		$title = 'Документы';

		activity()->log('Страница: '.$title);

		return Inertia::render('Maintenance/DocumentsOverviewPage', [
			'title' => $title,
			'path' => '',
			'isSearch' => (bool) request()->query('search'),
			'files' => request()->query('search') ? $this->getSearchContent() : $this->getDirectoryContent(),
		]);
	}

	public function view(string $path = '')
	{
		$title = 'Директория - '.$path;

		activity()->log('Страница: '.$title);

		return Inertia::render('Maintenance/DocumentsOverviewPage', [
			'title' => $title,
			'path' => $path,
			'isSearch' => (bool) request()->query('search'),
			'files' => request()->query('search') ? $this->getSearchContent() : $this->getDirectoryContent(),
		]);
	}

	public function store(CreateDocumentDirectoryRequest $request)
	{
		$validated = $request->validated();

		Storage::disk('documents')->makeDirectory(request()->path.'/'.$validated['name']);

		$logMessage = 'Создал директорию: '.basename($validated['name']);

		if (request()->path) {
			$logMessage .= ' в директории '.request()->path;
		}

		activity()->log($logMessage);

		return back();
	}

	public function upload(UploadDocumentRequest $request)
	{
		$validated = $request->validated();
		$fileNames = [];

		if ( ! empty($validated['documents'])) {
			foreach ($validated['documents'] as $document) {
				Storage::disk('documents')->putFileAs(
					request()->path, $document, $document->getClientOriginalName()
				);

				$fileNames[] = $document->getClientOriginalName();
			}
		}

		$logMessage = 'Загрузил файл(ы): '.implode(', ', $fileNames);

		if (request()->path) {
			$logMessage .= ' в директории '.request()->path;
		}

		activity()->log($logMessage);

		return back();
	}

	public function download($path)
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

		activity()->log($logMessage);

		return Storage::disk('documents')->download($path);
	}

	public function destroy(Request $request)
	{
		if (!Storage::disk('documents')->exists($request->path)) {
			return back();
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

		activity()->log($logMessage);

		return back();
	}

	private function getDirectoryContent()
	{
		$path = request()->path;
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
				'name' => str_replace('_', ' ', basename($directory)),
				'description' => 'Файлов: '.count(Storage::disk('documents')->allFiles($directory)),
				'path' => $directory,
			];
		});

		$filesRaw = Storage::disk('documents')->files($path);

		$files = Arr::map($filesRaw, function ($file) {
			return [
				'type' => 'file',
				'name' => str_replace('_', ' ', basename($file)),
				'description' => '',
				'path' => $file,
			];
		});

		return Arr::collapse([($upDirectory ? [$upDirectory] : []), $directories, $files]);
	}

	private function getSearchContent()
	{
		$path = request()->path;
		$searchString = Str::lower(request()->query('search', ''));
		$allDirectories = Storage::disk('documents')->allDirectories($path);

		$foundDirectories = Arr::where($allDirectories, function ($directory) use ($searchString) {
			return Str::contains(basename(Str::lower($directory)), $searchString);
		});

		$directories = Arr::map($foundDirectories, function ($directory) {
			return [
				'type' => 'directory',
				'name' => str_replace('_', ' ', basename($directory)),
				'description' => 'Файлов: '.count(Storage::disk('documents')->allFiles($directory)),
				'path' => $directory,
			];
		});

		$allFiles = Storage::disk('documents')->allFiles($path);

		$foundFiles = Arr::where($allFiles, function ($file) use ($searchString) {
			return Str::contains(basename(Str::lower($file)), $searchString);
		});

		$files = Arr::map($foundFiles, function ($file) {
			return [
				'type' => 'file',
				'name' => str_replace('_', ' ', basename($file)),
				'description' => '',
				'path' => $file,
			];
		});

		return Arr::collapse([$directories, $files]);
	}
}
