<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {

    }

    public function show($id)
    {
        $article = Article::where('status', 'publish')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
        
        $top_cat = Category::orderBy('name', 'asc')
            ->limit(4)
            ->get();
        
        $top_artikel = Article::orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        $today = Carbon::now()->isoFormat('dddd, D MMMM Y');

        $categories = Category::orderBy('name')->get()->pluck('name', 'id');

        return view('front.artikel', compact('article', 'today', 'categories', 'top_cat', 'top_artikel'));
    }
}
