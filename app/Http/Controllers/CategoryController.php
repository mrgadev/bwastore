<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        $products = Product::with(['galleries'])->simplePaginate(12);
        return view('pages.category',[
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function detail(Request $request, $slug) {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with(['galleries'])->where('categories_id', $category->id)->simplePaginate(12);
        return view('pages.category',[
            'products' => $products,
            'categories' => $categories,

        ]);
    }
}
