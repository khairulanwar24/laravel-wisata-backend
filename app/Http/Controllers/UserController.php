<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //index
    public function index() {
        $users = User::paginate(10);
        return view('pages.users.index', compact('users')); // butuh folder users dan file index
    }

    // create user
    public function create() {
        return view('pages.users.create');
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required',
            'role' => 'required',
        ]);

        User::create($request->all());
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }
}
