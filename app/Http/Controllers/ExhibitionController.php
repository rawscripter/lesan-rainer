<?php

namespace App\Http\Controllers;

use App\Exhibition;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExhibitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $exhibitions = Exhibition::orderBy('created_at', 'desc')->get();
        return view('admin.exhibition.index', compact('exhibitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.exhibition.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        if ($request->hasFile('image'))
            $data['image'] = ImageController::uploadImage($request->image);

        $exh = Exhibition::create($data);

        if ($exh) {
            return redirect()->back()->with('message', 'Exhibition Published');
        } else {
            return redirect()->back()->with('error', 'Something wrong. Please try after sometime.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Exhibition $exhibition
     * @return \Illuminate\Http\Response
     */
    public function show(Exhibition $exhibition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Exhibition $exhibition
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Exhibition $exhibition)
    {
        return view('admin.exhibition.edit', compact('exhibition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Exhibition $exhibition
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Exhibition $exhibition)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        if ($request->hasFile('image'))
            $data['image'] = ImageController::uploadImage($request->image);

        $exh = $exhibition->update($data);

        if ($exh) {
            return redirect()->back()->with('message', 'Exhibition Updated');
        } else {
            return redirect()->back()->with('error', 'Something wrong. Please try after sometime.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Exhibition $exhibition
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Exhibition $exhibition)
    {
        if ($exhibition->delete()) {
            return redirect()->back()->with('message', 'Exhibition Deleted');
        } else {
            return redirect()->back()->with('error', 'Something wrong. Please try after sometime.');
        }
    }
}
