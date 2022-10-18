<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\User;
use App\Cat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $cats = Cat::latest()->orderBy('id', 'DESC')->paginate(10);
        return view('map', compact('cats'));

        // return $cats;
    }

    public function index1()
    {
        $cats = Cat::latest()->orderBy('id', 'DESC')->paginate(10);
        return view('map1', compact('cats'))->with('no', 1);
    }

    public function index2()
    {
        $cats = Cat::latest()->orderBy('id', 'DESC')->paginate(10);
        return view('map2', compact('cats'));
    }

}
