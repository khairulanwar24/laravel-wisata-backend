<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //index
    public function index(Request $request)
    {
        $categories = Category::when($request->keyword, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->keyword}%")
                ->orWhere('description', 'like', "%{$request->keyword}%");
        })->orderBy('id', 'desc')->paginate(10);
        return view('pages.categories.index', compact('categories'));
    }

    //create
    public function create()
    {
        return view('pages.categories.create');
    }


}
