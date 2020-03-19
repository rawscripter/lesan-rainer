<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $page = 'articles';
        $articles = Article::all();
        return view('admin.article.index', compact('articles', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.create');
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
        $article = Article::create($data);
        if ($article) {
            return redirect()->back()->with('message', 'Article Published');
        } else {
            return redirect()->back()->with('error', 'Something wrong. Please try after sometime.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Article $article)
    {
        return view('admin.article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Article $article)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        if ($request->hasFile('image'))
            $data['image'] = ImageController::uploadImage($request->image);
        $article = $article->update($data);
        if ($article) {
            return redirect()->back()->with('message', 'Article Published');
        } else {
            return redirect()->back()->with('error', 'Something wrong. Please try after sometime.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        if ($article->delete()) {
            return redirect()->back()->with('message', 'Article Published');
        } else {
            return redirect()->back()->with('error', 'Something wrong. Please try after sometime.');
        }
    }
}
