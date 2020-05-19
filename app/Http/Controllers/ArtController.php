<?php

namespace App\Http\Controllers;

use App\Art;
use App\ArtCollection;
use App\ArtImage;
use App\Collection;
use App\Image;
use App\Jobs\ImageCropJob;
use App\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class ArtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $page = 'arts';
        $arts = Art::whereArchive(0)->orderBy('created_at', 'desc')->get();
        return view('admin.art.index', compact('page', 'arts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $collections = Collection::where('name', '!=', 'ALL')->pluck('name', 'id')->all();
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
        $data = $this->validateArtReq($request);
        $data['hidden_info'] = $request->hidden_info;
        $data['mold_name'] = $request->mold_name;
        $data['video_url'] = $request->video_url;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $artName = $request->name;
            $dbImage = ImageController::uploadArtImageToDropbox($artName, $image);
            $data['image'] = $dbImage['name'];

            $imageUrl = str_replace('?dl=0', '?dl=1', $dbImage['url']);
            $data['dropbox_url'] = $imageUrl;
            ImageController::cropImageFromDropbox($dbImage['name'], $imageUrl);
            // ImageCropJob::dispatch($dbImage['name'], $imageUrl);
        }
        if (isset($request->archive)) {
            $data['archive'] = 1;
        }
        $art = Art::create($data);

        if (!empty($request->collection)) {
            foreach ($request->collection as $collection) {
                ArtCollection::create(
                    [
                        'collection_id' => $collection,
                        'art_id' => $art->id,
                    ]
                );
            }
        }
        if ($art) {
            $title = 'Added';
            $body = 'Added a Art: ' . $art->name;
            $this->addUserLogForCollection($title, $body);
        }
        return redirect(route('arts.edit', $art->id))->with('message', 'Art Added to Database');

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Art $art)
    {
        $collections = Collection::where('name', '!=', 'ALL')->get();
        $uploadedImages = \App\Image::orderBy('created_at', 'desc')->get();
        $artImages = $art->relatedImages;
        $availableUploadedImages = $uploadedImages->diff($artImages);
        $availableCollections = $collections->diff($art->collections);
        $availableCollections = $availableCollections->pluck('name', 'id');
        return view('admin.art.edit', compact('collections', 'art', 'availableUploadedImages', 'availableCollections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Art $art
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Art $art)
    {
        $data = $this->validateArtReq($request);
        $data['hidden_info'] = $request->hidden_info;
        $data['mold_name'] = $request->mold_name;
        $data['video_url'] = $request->video_url;

        $name = 'b793b180-8966-11ea-ac82-6f910ce4c6f5.png';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $artName = $request->name;
            $dbImage = ImageController::uploadArtImageToDropbox($artName, $image);
            $data['image'] = $dbImage['name'];
            $imageUrl = str_replace('?dl=0', '?dl=1', $dbImage['url']);
            $data['dropbox_url'] = $imageUrl;
            ImageController::cropImageFromDropbox($dbImage['name'], $imageUrl);
            //       ImageCropJob::dispatch($dbImage['name'], $imageUrl);
        } else {
            $data['image'] = $art->image;
        }

        if (!empty($request->collection)) {
            foreach ($request->collection as $collection) {
                ArtCollection::create(
                    [
                        'collection_id' => $collection,
                        'art_id' => $art->id,
                    ]
                );
            }
        }

        if (!empty($request->removeCollection)) {
            foreach ($request->removeCollection as $collection) {
                $collections = ArtCollection::where('art_id', $art->id)->where('collection_id', $collection)->delete();
            }
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

    public function test()
    {

    }
}
