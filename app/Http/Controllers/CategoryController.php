<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    protected $paginate = 10;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Category::orderBy('name')
            ->when($request->has('q') && $request->q != "", function ($query) use ($request) {
                $query->where('name', 'LIKE', '%'. $request->q .'%');
            })
            ->paginate($request->rows ?? $this->paginate)
            ->appends($request->only('rows', 'q'));

        return view('category.index', compact('category'));
    }

    // public function data(Request $request)
    // {
    //     $query = Category::with('role')
    //         ->withCount('campaigns')
    //         ->withSum([
    //             'donations' => function ($query) {
    //                 $query->where('status', 'confirmed');
    //             }
    //         ], 'nominal')
    //         ->donatur()
    //         ->when($request->has('email') && $request->email != "", function ($query) use ($request) {
    //             $query->where('email', $request->email);
    //         })
    //         ->orderBy('name');

    //     return datatables($query)
    //         ->addIndexColumn()
    //         ->editColumn('name', function ($query) {
    //             return $query->name . '<br><a target="_blank" href="mailto:'. $query->email .'">'. $query->email .'</a>';
    //         })
    //         ->editColumn('path_image', function ($query) {
    //             if (Storage::disk('public')->exists($query->path_image)) {
    //                 return '<img src="'. Storage::disk('public')->url($query->path_image) .'" class="img-thumbnail">';
    //             } else {
    //                 return '<img src="'. asset('AdminLTE/dist/img/user1-128x128.jpg') .'" class="img-thumbnail">';
    //             }
    //         })
    //         ->editColumn('campaigns_count', function ($query) {
    //             return format_uang($query->campaigns_count);
    //         })
    //         ->editColumn('donations_sum_nominal', function ($query) {
    //             return format_uang($query->donations_sum_nominal);
    //         })
    //         ->editColumn('created_at', function ($query) {
    //             return tanggal_indonesia($query->created_at);
    //         })
    //         ->addColumn('action', function ($query) {
    //             return '
    //                 <button onclick="editForm(`'. route('donatur.show', $query->id) .'`)" class="btn btn-link text-primary"><i class="fas fa-pencil-alt"></i></button>
    //                 <button class="btn btn-link text-danger" onclick="deleteData(`'. route('donatur.destroy', $query->id) .'`)"><i class="fas fa-trash-alt"></i></button>
    //             ';
    //         })
    //         ->escapeColumns([])
    //         ->make(true);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255']
            
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data['name'] = $request->nama;
        $data['slug'] = Str::slug($request->nama);
        $category = Category::create($data);

        return response()->json(['data' => $category, 'message' => 'Kategori berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json(['data' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param  $id
     * @return \Illuminate\Http\Response
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Category $category)
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return response()->json(['data' => null, 'message' => 'Kategori berhasil dihapus']);

        // $category->delete();

        // return redirect()->route('category.index')
        //     ->with([
        //         'message' => 'Kategori berhasil dihapus',
        //         'success' => true,
        //     ]);
    }
}
