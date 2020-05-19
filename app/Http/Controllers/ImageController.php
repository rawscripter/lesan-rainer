<?php

namespace App\Http\Controllers;

use App\Art;
use App\ArtImage;
use App\Image;
use App\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;
use Webpatser\Uuid\Uuid;

class ImageController extends Controller
{

    public static function uploadArtImageToDropbox($artName, $image)
    {
        $dropboxClient = new Client('E3t4lWz1AIAAAAAAAAACG_nYzxTovatEutZbjFAF7uwyjHckQz6sBh98wLBzcnUu');
        $adapter = new DropboxAdapter($dropboxClient);
        $filesystem = new Filesystem($adapter);
        $imageName = $artName . '.' . $image->getClientOriginalExtension();
        $localImagePath = $image->getRealPath();

        $filesystem->put($imageName, file_get_contents($localImagePath), []);

        return $dropboxClient->createSharedLinkWithSettings($imageName);


    }

    public static function cropImageFromDropbox($name, $remoteUrl)
    {
        $image = $img = \Intervention\Image\Facades\Image::make($remoteUrl);
        //image for thumb
        $img->backup();
        $destinationPath = public_path('/images/thumb');
        $img->resize(200, 200)->save($destinationPath . '/' . $name);
        $img->reset();
        //image for for slider
        $destinationPath = public_path('/images/feature');
        $img->resize(800, 800)->save($destinationPath . '/' . $name);

    }

    public static function uploadImage($image)
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

    public function uploadArtImages(Request $request, Art $art)
    {
        $photos = $request->file('file');

        if (!is_array($photos)) {
            $photos = [$photos];
        }

        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];
            $imageName = $this->uploadImage($photo);
            $image = Image::create(
                ['name' => $imageName]
            );

            ArtImage::create([
                'art_id' => $art->id,
                'image_id' => $image->id,
            ]);
        }

        return Response::json([
            'message' => 'Image saved Successfully'
        ], 200);
    }

}
