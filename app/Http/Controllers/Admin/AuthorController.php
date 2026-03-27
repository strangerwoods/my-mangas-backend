<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return view('admin.author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.author.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $newAuthor = new Author();
        $newAuthor->name = $data['name'];
        $newAuthor->bio = $data['bio'] ?? null;
        $newAuthor->nationality = $data['nationality'] ?? null;
        $newAuthor->save();

        return redirect()->route('admin.authors.show', $newAuthor);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        $author->load('manga');
        return view('admin.author.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('admin.author.form', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $data = $request->all();

        $author->name = $data['name'];
        $author->bio = $data['bio'] ?? null;
        $author->nationality = $data['nationality'] ?? null;
        $author->save();

        return redirect()->route('admin.authors.show', $author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('admin.authors.index');
    }
}
