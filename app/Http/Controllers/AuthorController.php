<?php

namespace App\Http\Controllers;

use App\Map;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function profile($username)
    {
        $author = User::where('username', $username)->first();
        $posts = $author->posts()->latest()->approved()->published()->get();
        // $maps = Map::latest()->orderBy('id', 'DESC')->paginate(10);
        return view('profile', compact('author', 'posts'));
    }
}
