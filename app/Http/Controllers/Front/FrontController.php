<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ArticleController;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FrontController extends Controller
{
    public function index()
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

        return view('welcome', compact('article', 'today', 'categories', 'top_cat', 'top_artikel'));
    }
    
    public function showArticle($id)
    {
        $categories = Category::orderBy('name')->get()->pluck('name', 'id');
        $today = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $article = Article::findOrFail($id);

        return view('front.artikel', compact('article', 'today', 'categories'));

    }
}
