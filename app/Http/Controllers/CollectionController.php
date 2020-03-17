<?php

namespace App\Http\Controllers;

use App\c;
use App\Collection;
use App\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'collections';
        $collections = Collection::orderBy('created_at', 'desc')->get();
        return view('admin.collection.index', compact('collections', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.collection.create');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\c $c
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:30|unique:collections',
        ]);
        $res = Collection::create($data);

        if ($res) {
            $title = 'Added';
            $body = 'Updated A Collection To ' . $res->name;
            $this->addUserLogForCollection($title, $body);
        }

        return redirect()->back()->with('message', 'Sculpture Added to Database');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\c $c
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        return view('admin.collection.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\c $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        $data = $request->validate([
            'name' => 'required|max:30',
        ]);
        $res = $collection->update($data);

        if ($res) {
            $title = 'Updated';
            $body = 'Updated A Collection To ' . $collection->name;
            $this->addUserLogForCollection($title, $body);
        }

        return redirect()->back()->with('message', 'Sculpture Updated to Database');
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {

        if ($collection) {
            $title = 'Deleted';
            $body = 'Deleted A Collection ' . $collection->name;
            $this->addUserLogForCollection($title, $body);
        }


        $collection->delete();
        return redirect()->back()->with('message', 'Sculpture deleted from Database');
    }

    public function addUserLogForCollection($title, $body)
    {
        $title = "Collection " . $title;
        $body = Auth::user()->name . ' ' . $body;
        UserLog::create([
            'title' => $title,
            'body' => $body
        ]);
    }
}
