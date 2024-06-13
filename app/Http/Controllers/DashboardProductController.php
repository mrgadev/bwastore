<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ProductRequest;

class DashboardProductController extends Controller
{
    public function index() {
        $products = Product::with(['galleries', 'categories'])->where('users_id', Auth::user()->id)->get();
        return view('pages.dashboard-products',[
            'products' => $products
        ]);
    }

    public function create() {
        $categories = Category::all();
        return view('pages.dashboard-products-create', [
            'categories' => $categories
        ]);
    }

    public function store(ProductRequest $request) {
        // ambil semua data yg dikirim oleh product
        $data = $request->all();
        // ambil dan enkripsi data password
        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);
        $gallery = [
            'products_id' => $product->id,
            'photos' => $request->file('photo')->store('assets/product', 'public'),
        ];

        ProductGallery::create($gallery);
        return redirect()->route('dashboard-products');
    }

    public function detail(Request $request) {
        // Ambil model product dengan relasi ke model gallery, user dan category, yg idnya sama dengan request yg dikirim
        $product = Product::with(['galleries', 'user', 'categories'])->find($request->id);
        // ambil semua data kategori
        $categories = Category::all();
        // return ke view beserta datanya
        return view('pages.dashboard-products-details', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function uploadGallery(Request $request) {
        // ambil semua data yg dikirim oleh product
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('assets/product', 'public');
        // ambil dan enkripsi data password
        $data['slug'] = Str::slug($request->name);

        ProductGallery::create($data);
        return redirect()->route('dashboard-products-details', $request->products_id);
    }

    public function deleteGallery(Request $request, $id) {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard-products-details', $item->products_id);
    }

    public function update(Request $request, $id) {
        // ambil semua data yg dikirim oleh product
        $data = $request->all();
        
        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('dashboard-products');
    
}
}