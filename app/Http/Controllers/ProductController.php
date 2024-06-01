<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // index
    public function index(Request $request) {
        $products = Product::when($request->keyword, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->keyword}%")
                ->orWhere('description', 'like', "%{$request->keyword}%");

        })->orderBy('id', 'desc')->paginate(10);
        return view('pages.products.index', compact('products'));
    }
}
