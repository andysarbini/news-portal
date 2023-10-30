<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('name')->get()->pluck('name', 'id');

        return view('article.index', compact('category'));
    }

    public function data(Request $request)
    {
        $query = Article::when(auth()->user()->hasRole('author'), function ($query) {
                $query->author();
            })
            ->when($request->has('status') && $request->status != "", function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            // ->when(
            //     $request->has('start_date') && 
            //     $request->start_date != "" && 
            //     $request->has('end_date') && 
            //     $request->end_date != "", 
            //     function ($query) use ($request) {
            //         $query->whereBetween('publish_date', $request->only('start_date', 'end_date'));
            //     }
            // )
            ->orderBy('publish_date', 'desc');
            return datatables($query)
            ->addIndexColumn()
            ->editColumn('short_description', function ($query) {
                return $query->title .'<br><small>'. $query->short_description .'</small>';
            })
            ->editColumn('image', function ($query) {
                return '<img src="'. Storage::disk('public')->url($query->image) .'" class="img-thumbnail preview-path_image" width="150">';
            })
            ->addColumn('kategori', function ($query) {
                return $query->kategori->name;
            })
            ->editColumn('status', function ($query) {
                return '<span class="badge badge-'. $query->statusColor() .'">'. $query->status .'</span>';
            })
            ->addColumn('author', function ($query) {
                return $query->user->name;
            })
            ->addColumn('action', function ($query) {
                $text = '
                    <a href="'. route('article.show', $query->id) .'" class="btn btn-link text-dark"><i class="fas fa-search-plus"></i></a>
                ';

                if (auth()->user()->hasRole('author')) {
                    $text .= '
                        <a href="'. url('/article/'. $query->id .'/edit') .'" class="btn btn-link text-primary"><i class="fas fa-pencil-alt"></i></a>
                    ';
                } else {
                    $text .= '
                        <button onclick="editForm(`'. route('article.show', $query->id) .'`)" class="btn btn-link text-primary"><i class="fas fa-pencil-alt"></i></button>
                    ';
                }

                $text .= '
                    <button class="btn btn-link text-danger" onclick="deleteData(`'. route('article.destroy', $query->id) .'`)"><i class="fas fa-trash-alt"></i></button>
                ';

                return $text;
            })
            ->rawColumns(['short_description', 'image', 'kategori', 'status', 'action'])
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'path_image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'title' => 'required|min:8',
            'short_description' => 'required',
            'description' => 'required|min:8',
            'status' => 'required|in:publish,archived',
            'category' => 'required'            
        ];

        if (auth()->user()->hasRole('donatur')) {
            $rules['status'] = 'nullable';
        }

        $validator = Validator::make($request->all(), $rules, [
            'goal.min' => 'Nominal minimal 100.000'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except('path_image');
        $data['slug'] = Str::slug($request->title);
        $data['image'] = upload('article', $request->file('path_image'), 'article');
        $data['user_id'] = auth()->id();

        $article = Article::create($data);

        return response()->json(['data' => $article, 'message' => 'Artikel berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Article $article)
    {
        $article = $article->load('kategori');

        if (auth()->user()->hasRole('author') && $article->user_id != auth()->id()) {
            abort(404);
        }

        if (! $request->ajax()) {
            return view('article.show', compact('article'));
        }

        // $article->publish_date = date('Y-m-d H:i', strtotime($article->publish_date));
        // $article->end_date = date('Y-m-d H:i', strtotime($article->end_date));
        // $article->goal = format_uang($article->goal);
        $article->categories = $article->category_article;
        $article->path_image = Storage::disk('public')->url($article->image);

        return response()->json(['data' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $rules = [
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'title' => 'required|min:8',
            'slug' => 'required|min:8',
            'short_description' => 'required',
            'description' => 'required|min:8',
            'status' => 'required|in:publish,archived',
            'category' => 'required'
        ];

        if (auth()->user()->hasRole('author')) {
            $rules['status'] = 'nullable';
        }

        $data = $request->except('path_image', 'categories');
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }

            $data['image'] = upload('article', $request->file('image'), 'article');
        }

        $article->update($data);
        // $article->category_article()->sync($request->categories);

        return response()->json(['data' => $article, 'message' => 'Artikel berhasil diperbarui']);
    }

    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:publish,archived,pending',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $article = Article::findOrFail($id);
        $article->update($request->only('status'));

        $statusText = "";
        if ($request->status == 'publish') {
            $statusText = 'dikonfirmasi';
        } elseif ($request->status == 'archived') {
            $statusText = 'diarsipkan';
        }

        return response()->json(['data' => $article, 'message' => 'Artikel berhasil '. $statusText]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if (Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return response()->json(['data' => null, 'message' => 'Artikel berhasil dihapus']);
    }    
    
}
