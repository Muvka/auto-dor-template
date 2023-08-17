<?php

namespace App\Http\Controllers\Client\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrivateFileController extends Controller
{
	public function download(Request $request)
	{
		abort_if(
			! Storage::disk('private')->exists($request->file),
			404,
			'Такого файла не существует.'
		);

		return Storage::disk('private')->download($request->file, $request->name);
	}
}
