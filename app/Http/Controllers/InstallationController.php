<?php

namespace App\Http\Controllers;

use App\Art;
use App\Installation;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class InstallationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $installations = Installation::all();
        return view('admin.installtion.index', compact('installations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arts = Art::pluck('name', 'id')->all();
        return view('admin.installtion.create', compact('arts'));
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
        if ($request->hasFile('image_1'))
            $data['image_1'] = $this->uploadImage($request->image_1);
        if ($request->hasFile('image_2'))
            $data['image_2'] = $this->uploadImage($request->image_2);
        if ($request->hasFile('image_3'))
            $data['image_3'] = $this->uploadImage($request->image_3);
        $installation = Installation::create($data);
        if ($installation) {
            return redirect()->back()->with('message', 'Added to Database');
        } else {
            return redirect()->back()->with('error', 'Something wrong. Please try after sometime.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Installation $installation
     * @return \Illuminate\Http\Response
     */
    public function show(Installation $installation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Installation $installation
     * @return \Illuminate\Http\Response
     */
    public function edit(Installation $installation)
    {
        $arts = Art::pluck('name', 'id')->all();
        return view('admin.installtion.edit', compact('installation', 'arts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Installation $installation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Installation $installation)
    {
        $data = $request->all();
        if ($request->hasFile('image_1'))
            $data['image_1'] = $this->uploadImage($request->image_1);
        if ($request->hasFile('image_2'))
            $data['image_2'] = $this->uploadImage($request->image_2);
        if ($request->hasFile('image_3'))
            $data['image_3'] = $this->uploadImage($request->image_3);
        $installation = $installation->update($data);
        if ($installation) {
            return redirect()->back()->with('message', 'Added to Database');
        } else {
            return redirect()->back()->with('error', 'Something wrong. Please try after sometime.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Installation $installation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Installation $installation)
    {
        if ($installation->delete()) {
            return redirect()->back()->with('message', 'Deleted From Database');
        } else {
            return redirect()->back()->with('error', 'Something wrong. Please try after sometime.');
        }
    }

    private function uploadImage($image)
    {
        $imageName = Uuid::generate()->string . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/images/thumb');
        $img = \Intervention\Image\Facades\Image::make($image->getRealPath());
        // backup status
        $img->backup();
        //image for thumb
        $img->resize(200, 200)->save($destinationPath . '/' . $imageName);
        $img->reset();
        //image for for slider
        $destinationPath = public_path('/images/feature');
        $img->resize(800, 800)->save($destinationPath . '/' . $imageName);
        $img->reset();
        //uploading original image
        $destinationPath = public_path('/images/arts');
        $img->save($destinationPath . '/' . $imageName);
        return $imageName;
    }
}
