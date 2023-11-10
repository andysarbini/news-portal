<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        return view('gallery.index');
    }

    public function data(Request $request)
    {
        $query = Gallery::when(auth()->user()->hasRole('author'), function ($query) {
                $query->author();
            })            
            ->orderBy('created_at', 'desc');
            return datatables($query)
            ->addIndexColumn()
            ->editColumn('image', function ($query) {
                return '<img src="'. Storage::disk('public')->url($query->gambar) .'" class="img-thumbnail preview-path_image" width="150">';
            })
            ->editColumn('judul', function ($query) {
                return $query->title .'<br><small>'. $query->title .'</small>';
            })
            ->editColumn('deskripsi', function ($query) {
                return $query->title .'<br><small>'. $query->description .'</small>';
            })            
            ->addColumn('action', function ($query) {
                $text = '
                    <a href="'. route('gallery.show', $query->id) .'" class="btn btn-link text-dark"><i class="fas fa-search-plus"></i></a>
                ';
              
                $text .= '
                    <button onclick="editForm(`'. route('gallery.show', $query->id) .'`)" class="btn btn-link text-primary"><i class="fas fa-pencil-alt"></i></button>
                ';

                $text .= '
                    <button class="btn btn-link text-danger" onclick="deleteData(`'. route('gallery.destroy', $query->id) .'`)"><i class="fas fa-trash-alt"></i></button>
                ';

                return $text;
            })
            ->rawColumns(['title'])
            ->escapeColumns([])
            ->make(true);
    }

    public function store(Request $request)
    {
        $rules = [
            'path_image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'title' => 'required|min:8',
            'description' => 'required'            
        ];

        $validator = Validator::make($request->all(), $rules, [
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except('path_image');
        $data['slug'] = Str::slug($request->title);
        $data['gambar'] = upload('gallery', $request->file('path_image'), 'gallery');
        $data['user_id'] = auth()->id();

        $gallery = Gallery::create($data);

        return response()->json(['data' => $gallery, 'message' => 'Gallery berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Gallery $gallery)
    {

        if (auth()->user()->hasRole('author') && $gallery->user_id != auth()->id()) {
            abort(404);
        }

        if (! $request->ajax()) {
            return view('gallery.show', compact('gallery'));
        }

        $gallery->path_image = Storage::disk('public')->url($gallery->gambar);

        return response()->json(['data' => $gallery]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $rules = [
            'path_image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'title' => 'required|min:8',
            'description' => 'required|min:8',
        ];

        $data = $request->except('path_image');
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('path_image')) {
            if (Storage::disk('public')->exists($gallery->gambar)) {
                Storage::disk('public')->delete($gallery->gambar);
            }

            $data['gambar'] = upload('gallery', $request->file('path_image'), 'gallery');
        }

        $gallery->update($data);

        return response()->json(['data' => $gallery, 'message' => 'Gallery berhasil diperbarui']);
    }
}
