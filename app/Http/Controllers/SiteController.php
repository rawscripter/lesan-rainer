<?php

namespace App\Http\Controllers;

use App\AboutPageSetting;
use App\Art;
use App\Article;
use App\Collection;
use App\Exhibition;
use App\HomePageSetting;
use App\Installation;
use App\Mail\SendMail;
use App\Visitor;
use Barryvdh\DomPDF\PDF as PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

class SiteController extends Controller
{
    public function index()
    {
        $this->addVisitor();
        $page = 'home';
        $homePageContents = HomePageSetting::first();
        $arts = Art::orderBy('created_at', 'desc')->whereArchive(0)->take(5)->get();
        $collections = Collection::orderBy('name', 'asc')->get();
        return view('site.index', compact('page', 'arts', 'homePageContents', 'collections'));
    }

    public function about()
    {
        $this->addVisitor();
        $page = 'about';
        $aboutPageSettings = AboutPageSetting::first();
        $collections = Collection::orderBy('name', 'asc')->get();
        return view('site.about', compact('page', 'collections', 'aboutPageSettings'));
    }

    public function contact()
    {
        $this->addVisitor();
        $page = 'contact';
        $collections = Collection::orderBy('name', 'asc')->get();
        return view('site.contact', compact('page', 'collections'));
    }

    public function showCollection(Collection $collection)
    {

        $page = 'collection';
        $collections = Collection::orderBy('name', 'asc')->get();

        if (strtolower($collection->name) == 'all') {
            $arts = Art::whereArchive(0)->orderBy('created_at', 'desc')->latest()->paginate(8);
        } else {
            $arts = $collection->arts()->paginate(6);
        }

        return view('site.collection', compact('collections', 'page', 'collection', 'arts'));
    }

    public function showArchiveCollection(Collection $collection)
    {

        $page = 'collection';
        $collections = Collection::orderBy('name', 'asc')->get();

        if (strtolower($collection->name) == 'all') {
            $arts = Art::whereArchive(1)->orderBy('created_at', 'desc')->latest()->paginate(8);
        } else {
            $arts = $collection->archiveArts()->paginate(6);
        }

        return view('site.collection', compact('collections', 'page', 'collection', 'arts'));
    }


    public function archives()
    {
        $collections = Collection::orderBy('name', 'desc')->get();
        $arts = Art::whereArchive(1)->orderBy('created_at', 'desc')->latest()->paginate(8);
        return view('site.collection', compact('collections', 'page', 'arts'));
    }

    public function showArchives()
    {
        $page = 'collection';
        $collections = Collection::orderBy('created_at', 'asc')->get();
        $arts = Art::where('archive', 1)->orderBy('name', 'desc')->get();
        return view('site.collection', compact('collections', 'page', 'arts'));
    }

    public function showInstallations()
    {
        $page = 'installations';
        $collections = Collection::orderBy('name', 'desc')->get();
        if (isset($_GET['filter'])) {
            $type = $_GET['filter'];
            $installations = Installation::where('type', $type)->paginate(8);
        } else {
            $installations = Installation::paginate(81);
        }
        return view('site.inststallations', compact('collections', 'installations'));
    }

    public function articles()
    {
        $collections = Collection::orderBy('name', 'asc')->get();
        $articles = Article::orderBy('created_at', 'desc')->paginate(6);

        return view('site.articles', compact('collections', 'articles'));
    }

    public function readArticle($slug)
    {
        $article = Article::where('slug', $slug)->first();
        $collections = Collection::orderBy('name', 'asc')->get();
        return view('site.singleArticle', compact('article', 'collections'));
    }

    public function exhibitions()
    {
        $collections = Collection::orderBy('name', 'asc')->get();
        $exhibitions = Exhibition::orderBy('created_at', 'desc')->paginate(6);
        return view('site.exhibitions', compact('exhibitions', 'collections'));
    }

    public function showExhibitionDetailsModal(Exhibition $exhibition)
    {
        return response()->json([
            'modal' => view('site.exhibition-modal')->with('exhibition', $exhibition)->render()
        ]);
    }

    public function addVisitor()
    {
        $session_id = session()->getId();
        $visitor = Visitor::where('session_id', $session_id)->first();
        if (empty($visitor)) {
            Visitor::create([
                'session_id' => $session_id,
                'clicks' => 1,
                'user_ip' => \Request::ip()
            ]);
        } else {
            $visitor->increment('clicks');
        }
    }

    public function artDetailsModal(Art $art)
    {
        return response()->json([
            'modal' => view('site.art-modal')->with('art', $art)->render()
        ]);
    }

    public function installationDetailsModal(Installation $installation)
    {
        return response()->json([
            'modal' => view('site.installation-modal')->with('installation', $installation)->render()
        ]);
    }

    public function pdfGenerator(Art $art)
    {
        $dompdf = new Dompdf(array('enable_remote' => false));
        $html = view('site.art-pdf', compact('art'));
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->render();
        $file_name = $art->name . '.pdf';
        $dompdf->stream($file_name);
    }

    public function downloadArtImage(Art $art)
    {
        $oldPath = public_path('images/arts/') . $art->image;
        $fileExtension = \File::extension($oldPath);
        $newName = $art->name . '.' . $fileExtension;
        $newPathWithName = 'images/arts/' . $newName;
        \File::copy($oldPath, $newPathWithName);
        return Response::download($newPathWithName);
    }

    public function contactMail(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        $data = array(
            'name' => $request->name,
            'message' => $request->message,
            'email' => $request->email,
            'phone' => $request->phone,
        );
        Mail::to('rainerlagemann@me.com')->send(new SendMail($data));
        return redirect()->back()->with('success', 'Thanks for contacting us!');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
