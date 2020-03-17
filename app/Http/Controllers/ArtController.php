<?php

namespace App\Http\Controllers;

use App\Art;
use App\ArtImage;
use App\Collection;
use App\Image;
use App\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class ArtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'arts';
        $arts = Art::whereArchive(0)->orderBy('created_at', 'asc')->get();
        return view('admin.art.index', compact('page', 'arts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $collections = Collection::pluck('name', 'id')->all();
        $availableUploadedImages = \App\Image::orderBy('created_at', 'desc')->get();
        return view('admin.art.create', compact('collections', 'availableUploadedImages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//        return $request->all();
        $data = $this->validateArtReq($request);
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadArtImage($request);
        }
        if (isset($request->archive)) {
            $data['archive'] = 1;
        }
        $art = Art::create($data);
        if ($art) {
            $title = 'Added';
            $body = 'Added a Art: ' . $art->name;
            $this->addUserLogForCollection($title, $body);
        }
        return redirect()->back()->with('message', 'Art Added to Database');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Art $art
     * @return \Illuminate\Http\Response
     */
    public function show(Art $art)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Art $art
     * @return \Illuminate\Http\Response
     */
    public function edit(Art $art)
    {
        $collections = Collection::pluck('name', 'id')->all();
        $uploadedImages = \App\Image::orderBy('created_at', 'desc')->get();
        $artImages = $art->relatedImages;
        $availableUploadedImages = $uploadedImages->diff($artImages);
        return view('admin.art.edit', compact('collections', 'art', 'availableUploadedImages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Art $art
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Art $art)
    {
        $data = $this->validateArtReq($request);
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadArtImage($request);
            $this->UnlinkImage('images/arts/', $art->image);
            $this->UnlinkImage('images/feature/', $art->image);
            $this->UnlinkImage('images/thumb/', $art->image);
        } else {
            $data['image'] = $art->image;
        }
        if (!empty($request->removeImage)) {
            foreach ($request->removeImage as $img) {
                $images = ArtImage::where('image_id', $img)->where('art_id', $art->id)->get();
                foreach ($images as $image) {
                    $image->delete();
                    Image::find($image->image_id)->delete();
                }
            }
        }
        $res = $art->update($data);
        if ($res) {
            $title = 'Updated';
            $body = 'Updated a Art: ' . $art->name;
            $this->addUserLogForCollection($title, $body);
        }
        return redirect()->back()->with('message', 'Art info Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Art $art
     * @return \Illuminate\Http\Response
     */
    public function destroy(Art $art)
    {
        $this->UnlinkImage('images/arts/', $art->image);
        $this->UnlinkImage('images/feature/', $art->image);
        $this->UnlinkImage('images/thumb/', $art->image);
        if ($art) {
            $title = 'Deleted';
            $body = 'Deleted a Art: ' . $art->name;
            $this->addUserLogForCollection($title, $body);
        }
        $art->delete();
        return redirect()->back()->with('message', 'Art deleted from Database');
    }

    private function uploadArtImage($request)
    {
        $image = $request->file('image');
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

    private function UnlinkImage($filepath, $fileName)
    {
        $old_image = $filepath . $fileName;
        if (file_exists($old_image)) {
            @unlink($old_image);
        }
    }

    public function validateArtReq($request)
    {
        return $request->validate([
            'name' => 'required',
            'size1' => 'required',
            'size2' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'description' => 'required',
            'year' => 'required',
            'collection_id' => 'required',
        ]);
    }

    public function addUserLogForCollection($title, $body)
    {
        $title = "Art " . $title;
        $body = Auth::user()->name . ' ' . $body;
        UserLog::create([
            'title' => $title,
            'body' => $body
        ]);
    }
}
