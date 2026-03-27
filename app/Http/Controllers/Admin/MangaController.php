<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Manga;

class MangaController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$mangas = Manga::all();
		return view('admin.manga.index', compact('mangas'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.manga.form');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$data = $request->all();

		$newManga = new Manga();
		$newManga->title = $data['title'];
		$newManga->description = $data['description'];
		$newManga->volumes = $data['volumes'];
		$newManga->year = $data['year'];
		$newManga->status = $data['status'];
		$newManga->author_id = $data['author_id'];
		$newManga->publisher_id = $data['publisher_id'];

		if ($request->hasFile('cover_image')) {
			$imagePath = $request->file('cover_image')->store('mangas', 'public');
			$newManga->cover_image = $imagePath;
		}

		$newManga->save();

		if ($request->has('genres')) {
			$newManga->genres()->attach($data['genres']);
		}

		return redirect()->route('admin.manga.show', $newManga);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Manga $manga)
	{
		return view('admin.manga.show', compact('manga'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Manga $manga)
	{
		return view('admin.manga.form', compact('manga'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Manga $manga)
	{
		$data = $request->all();

		$manga->title = $data['title'];
		$manga->description = $data['description'];
		$manga->volumes = $data['volumes'];
		$manga->year = $data['year'];
		$manga->status = $data['status'];
		$manga->author_id = $data['author_id'];
		$manga->publisher_id = $data['publisher_id'];

		if ($request->has('delete_cover_image') && $request->delete_cover_image) {
			if ($manga->cover_image && Storage::disk('public')->exists($manga->cover_image)) {
				Storage::disk('public')->delete($manga->cover_image);
			}
			$manga->cover_image = null;
		}

		if ($request->hasFile('cover_image')) {
			if ($manga->cover_image && Storage::disk('public')->exists($manga->cover_image)) {
				Storage::disk('public')->delete($manga->cover_image);
			}
			$imagePath = $request->file('cover_image')->store('mangas', 'public');
			$manga->cover_image = $imagePath;
		}

		$manga->save();

		if ($request->has('genres')) {
			$manga->genres()->sync($data['genres'] ?? []);
		}

		return redirect()->route('admin.manga.show', $manga);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Manga $manga)
	{
		if ($manga->cover_image) {
			Storage::disk('public')->delete($manga->cover_image);
		}

		$manga->genres()->detach(); // ← clears genre_manga rows first
		$manga->delete();

		return redirect()->route('admin.manga.index')
			->with('success', '"' . $manga->title . '" deleted.');
	}
}
