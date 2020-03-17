<?php

namespace App\Http\Controllers;

use App\Art;
use App\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtArchiveController extends Controller
{

    public function showAllArchiveArts()
    {
        $page = 'archives';
        $arts = Art::whereArchive(1)->orderBy('created_at', 'asc')->get();
        return view('admin.art.archives', compact('page', 'arts'));
    }

    public function archiveArt(Art $art)
    {
        $art->archive = 1;
        $res = $art->save();

        if ($res) {
            $title = 'Archived';
            $body = 'Archived a Art: ' . $art->name;
            $this->addUserLogForCollection($title, $body);
        }


        return redirect()->back()->with('message', 'Art Work Archived');
    }

    public function restoreArt(Art $art)
    {
        $art->archive = 0;
        $res = $art->save();

        if ($res) {
            $title = 'Restored';
            $body = 'Archived a Art: ' . $art->name;
            $this->addUserLogForCollection($title, $body);
        }

        return redirect()->back()->with('message', 'Art Work Restored');
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
