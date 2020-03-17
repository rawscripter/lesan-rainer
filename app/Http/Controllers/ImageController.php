<?php

namespace App\Http\Controllers;

use App\Art;
use App\ArtImage;
use App\Image;
use App\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Webpatser\Uuid\Uuid;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'uploads';
        $images = Image::orderBy('created_at', 'DESC')->get();
        return view('admin.images.index', compact('page', 'images'));
    }

    public function uploadImagesPage()
    {
        return view('admin.images.upload');
    }

    public function uploadImage(Request $request, Art $art)
    {
        $photos = $request->file('file');
        if (!is_array($photos)) {
            $photos = [$photos];
        }
        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];
            $imageName = $this->uploadArtImage($photo);
            $image = Image::create(
                ['name' => $imageName]
            );
            ArtImage::create([
                'image_id' => $image->id,
                'art_id' => $art->id
            ]);
        }
        $title = 'Uploaded';
        $body = "Uploaded a Image";
        $this->addUserLogForCollection($title, $body);
        return Response::json([
            'message' => 'Image saved Successfully'
        ], 200);
    }

    public function deleteImage(Image $image)
    {
        $this->UnlinkImage('images/arts/', $image->name);
        $this->UnlinkImage('images/feature/', $image->name);
        $this->UnlinkImage('images/thumb/', $image->name);
        $res = $image->delete();
        if ($res) {
            $title = 'Deleted';
            $body = 'Deleted a Image ';
            $this->addUserLogForCollection($title, $body);
        }
        return redirect()->back()->with('message', 'Image Deleted from Database');
    }

    private function uploadArtImage($image)
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

    private function UnlinkImage($filepath, $fileName)
    {
        $old_image = $filepath . $fileName;
        if (file_exists($old_image)) {
            @unlink($old_image);
        }
    }

    public function addUserLogForCollection($title, $body)
    {
        $title = "Image " . $title;
        $body = Auth::user()->name . ' ' . $body;
        UserLog::create([
            'title' => $title,
            'body' => $body
        ]);
    }
}
