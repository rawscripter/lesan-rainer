<?php

namespace App\Http\Controllers;

use App\AboutPageSetting;
use App\HomePageSetting;
use App\PageSettings;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Webpatser\Uuid\Uuid;

class PageSettingsController extends Controller
{
    public function homePageSettings()
    {
        $page = 'settings';
        $homepage = HomePageSetting::first();
        return view('admin.settings.home', compact('homepage','page'));
    }

    public function updateHomePageSettings(Request $request)
    {
        $homePage = HomePageSetting::first();
        $input = $request->all();

        if (!empty($homePage->id)) {
            $homePage->update([
                'heading' => $input['heading'],
                'contents' => $input['contents'],
                'url' => $input['url'],
                'button_text' => $input['button_text'],
            ]);
        } else {
            HomePageSetting::create([
                'heading' => $input['heading'],
                'contents' => $input['contents'],
                'url' => $input['url'],
                'button_text' => $input['button_text'],
            ]);
        }
        return redirect()->back()->with('message', 'Home Page Contents Updated');
    }

//    for about page
    public function aboutPageSettings()
    {
        $page = 'settings';
        $aboutPage = AboutPageSetting::first();
        return view('admin.settings.about', compact('page','aboutPage'));
    }

    public function updateAboutPageSettings(Request $request)
    {
        $page = AboutPageSetting::first();
        $input = $request->all();

        if (!empty($page->id)) {

            if ($request->hasFile('image')) {
                $input['image'] = $this->uploadImage($request);
            } else {
                $input['image'] = $page->image;
            }
            $page->update([
                'heading' => $input['heading'],
                'contents' => $input['contents'],
                'image' => $input['image'],
            ]);
        } else {

            // upload image
            $input['image'] = $this->uploadImage($request);
            AboutPageSetting::create([
                'heading' => $input['heading'],
                'contents' => $input['contents'],
                'image' => $input['image'],
            ]);
        }
        return redirect()->back()->with('message', 'Home Page Contents Updated');
    }

    private function uploadImage($request)
    {
        $image = $request->file('image');
        $imageName = Uuid::generate()->string . '.' . $image->getClientOriginalExtension();

        //Saving the original size image
        $destinationPath = public_path('/images/pages');
        $image->move($destinationPath, $imageName);

        return $imageName;
    }

}
