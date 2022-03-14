<?php

namespace App\Http\Controllers;

use App\Notifications\AuthorPostApproved;
use Brian2694\Toastr\Facades\Toastr;
use App\Post;
use App\Category;
use App\Map;
use App\Catowner;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatownerController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pending', compact('users'));

        $categories = Category::all();
        $posts = Post::latest()->take(1)->get();
        $catowners = Catowner::latest()->orderBy('id', 'DESC')->paginate(10);
        return view('catowner', compact('categories', 'posts', 'catowners'));
    }

    public function pending()
    {
        $user = Auth::user();
        $catowners = Catowner::latest()->orderBy('id', 'DESC')->paginate(10);
        return view('pending', compact('catowners', 'user'));
    }

    public function changeStatus(Request $request)
    {
        $catowner = Catowner::find($request->user_id);
        $catowner->status = $request->status;
        $catowner->save();
        return view('changeStatus', compact('catowner'));
        return response()->json(['success' => 'Status change successfully.']);
    }

    public function approval($id)
    {

        $catowner = Catowner::find($id);
        if ($catowner->status == false) {
            $catowner->status == true;
            $catowner->save();
            $catowner->user->notify(new AuthorPostApproved($catowner));

            Toastr::success('Catowner Successfully Approved :)', 'Success');
        } else {
            Toastr::info('This Catowner is already approved', 'Info');
        }
        return redirect()->back();
    }
}
