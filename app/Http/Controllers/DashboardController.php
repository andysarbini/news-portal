<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Article;
use App\Models\Gallery;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahKategori = Category::count();
        $jumlahArtikel = Article::count();
        $jumlahGambar = Gallery::count();

        if (auth()->user()->hasRole('admin')) {
            return view('dashboard', compact(
                'jumlahKategori',
                'jumlahArtikel',
                'jumlahGambar'
            ));
        }

        return view('dashboard2');
    }
}
