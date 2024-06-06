<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // index
    public function index(Request $request) {
        $products = Product::with('category')->when($request->status, function ($query) use ($request) {
            $query->where('status', 'like', "%{$request->status}%");
        })->orderBy('favorite', 'desc')->get();
        return response()->json(['status'=>'success', 'data' => $products], 200);
    }
}
