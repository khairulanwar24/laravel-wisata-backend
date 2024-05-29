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
}
