<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Requests\Admin\ProductGalleryRequest;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax()) {
            $query = ProductGallery::with(['products']);

            return DataTables::of($query)
            ->addColumn('action', function($item) {
               return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                Aksi
                            </button>
                            <div class="dropdown-menu">
                                
                                <form action="'.route('product-gallery.destroy', $item->id).'" method="POST">
                                    '.method_field('delete').csrf_field().'
                                    <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
               '; 
            })
            ->editColumn('photos', function($item){
                return $item->photos ? '<img src="'.Storage::url($item->photos).'" style="max-height: 80px;">' : '';
            })
            // jangan lupa kolom yang ditambah dimasukkan k
            ->rawColumns(['action', 'photos'])
            ->make();
        }
        return view('pages.admin.product-gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ambil semua data dari tabel produk untuk ditautkan dengan foto yg akan diupload
        $products = Product::all();
        return view('pages.admin.product-gallery.create', [
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductGalleryRequest $request)
    {
         // ambil semua data yg dikirim oleh product
         $data = $request->all();
         $data['photos'] = $request->file('photos')->store('assets/product', 'public');
         // ambil dan enkripsi data password
         $data['slug'] = Str::slug($request->name);

         ProductGallery::create($data);
         return redirect()->route('product-gallery.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('product-gallery.index');
    }
}
