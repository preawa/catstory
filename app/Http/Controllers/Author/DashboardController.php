<?php

namespace App\Http\Controllers\Author;

use App\Cat;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Map;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $post = $user->posts;
        $popular_posts = $user->posts()
            ->withCount('comments')
            ->withCount('favorite_to_users')
            ->orderBy('view_count', 'desc')
            ->orderBy('comments_count')
            ->orderBy('favorite_to_users_count')
            ->take(5)->get();
        $total_pending_posts = $post->where('is_approved', false)->count();
        $all_views = $post->sum('view_count');
        $posts = Auth::user()->posts()->latest()->paginate(6);
        // $maps = Auth::User()->maps()->latest()->take(12)->get();
        // $mapss = Map::orderBy('id', 'DESC')->paginate(10);
        $cats = Auth::User()->cats()->latest()->take(10)->get();
        $cat = $user->cats;
        $total_pending_cats = $cat->where('is_approved', false)->count();
        $catss = Cat::orderBy('id', 'DESC')->paginate(10);
        return view('author.dashboard', compact(
            'post',
            'popular_posts',
            'total_pending_posts',
            'total_pending_cats',
            'all_views',
            'posts',
            // 'maps',
            // 'mapss',
            'cats',
            'catss'
        ));
    }

    public function index1()
    {
        $user = Auth::user();
        $post = $user->posts;
        $popular_posts = $user->posts()
            ->withCount('comments')
            ->withCount('favorite_to_users')
            ->orderBy('view_count', 'desc')
            ->orderBy('comments_count')
            ->orderBy('favorite_to_users_count')
            ->take(5)->get();
        $total_pending_posts = $post->where('is_approved', false)->count();
        $all_views = $post->sum('view_count');
        $posts = Auth::user()->posts()->latest()->paginate(6);
        // $maps = Auth::User()->maps()->latest()->take(12)->get();
        // $mapss = Map::orderBy('id', 'DESC')->paginate(10);
        $cats = Auth::User()->cats()->latest()->take(12)->get();
        $cat = $user->cats;
        $total_pending_cats = $cat->where('is_approved', false)->count();
        $catss = Cat::orderBy('id', 'DESC')->paginate(10);
        return view('author.dashboard1', compact(
            'post',
            'popular_posts',
            'total_pending_posts',
            'total_pending_cats',
            'all_views',
            'posts',
            // 'maps',
            // 'mapss',
            'cats',
            'catss'
        ));
    }
}
