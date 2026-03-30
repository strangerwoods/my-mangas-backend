<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manga;

class MangaController extends Controller
{
	public function index()
	{
		$mangas = Manga::with('author', 'publisher', 'genres')->get();
		return response()->json($mangas);
	}

	public function show(Manga $manga)
	{
		$manga->load('author', 'publisher', 'genres');
		return response()->json($manga);
	}
}
