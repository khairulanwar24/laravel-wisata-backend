<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // index
    public function index(Request $request) {
        $categories = Category::when($request->keyword, function($query) use ($request) {
            $query->where('name', 'like', "%{$request->keyword}%")
            ->orWhere('description', 'like', "%{$request->keyword}%");
        })->orderBy('id', 'desc')->paginate(10);
        return view('pages.categories.index', compact('categories'));
    }
}
