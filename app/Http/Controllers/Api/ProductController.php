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

    // store
    public function store(Request $request) {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
            'criteria' => 'required',
            'favorite' => 'required',
            'status' => 'required',
            'stock' => 'required',
        ]);

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->criteria = $request->criteria;
        $product->favorite = $request->favorite;
        $product->status = $request->status;
        $product->stock = $request->stock;
        $product->save();

        // upload image
        if ($request->file('image')) {
            $image = $request->file('image');
            $image->storeAs('public/products', $product->id . '.png');
            $product->image = $product->id . '.png';
            $product->save();
        }

        return response()->josn(['status' => 'success', 'data' => $product], 200);

    }
}
