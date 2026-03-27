<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publisher;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::all();
        return view('admin.publisher.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.publisher.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $newPublisher = new Publisher();
        $newPublisher->name = $data['name'];
        $newPublisher->country = $data['country'] ?? null;
        $newPublisher->save();

        return redirect()->route('admin.publishers.show', $newPublisher);
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        $publisher->load('manga');
        return view('admin.publisher.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        return view('admin.publisher.form', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $data = $request->all();

        $publisher->name = $data['name'];
        $publisher->country = $data['country'] ?? null;
        $publisher->save();

        return redirect()->route('admin.publishers.show', $publisher);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return redirect()->route('admin.publishers.index');
    }
}
