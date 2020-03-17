<?php

namespace App\Http\Controllers;

use App\Art;
use App\Collection;
use App\UserLog;
use App\Visitor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {

    }

    public function home()
    {
        $page = 'dashboard';
        $activeArts = Art::whereArchive(0)->get()->count();
        $archiveArts = Art::whereArchive(1)->get()->count();
        $collections = Collection::all()->count();
        $visitors = Visitor::all()->count();
        $logs = UserLog::orderBy('created_at', 'desc')->take(5)->get();;
        return view('admin.index', compact('page', 'activeArts', 'archiveArts', 'collections', 'visitors', 'logs'));
    }

    public function showAllLogs()
    {
        $page = 'logs';
        $logs = UserLog::orderBy('created_at', 'desc')->get();;
        return view('admin.logs.index', compact('page', 'logs'));
    }

    public function login()
    {
        return view('admin.login.login');
    }
}
