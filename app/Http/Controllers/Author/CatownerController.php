<?php

namespace App\Http\Controllers\Author;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AuthorPostApproved;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Cat;
use App\Catowner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewAuthorCatowner;

class CatownerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Auth::User()->cats()->latest()->get();
        // $cats = Cat::latest()->get();
        return view('author.dashboard', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $catowner = Catowner::all();
        return view('author.catowner.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'body' => 'required',
            'lat_long' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)) {
            //            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('cat')) {
                Storage::disk('public')->makeDirectory('cat');
            }

            $catownerImage = Image::make($image)->resize(1600, 1066)->stream();
            Storage::disk('public')->put('cat/' . $imageName, $catImage);
        } else {
            $imageName = "default.png";
        }

        $catowner = new Cat();
        $catowner->user_id = Auth::id();
        $catowner->name = $request->name;
        $catowner->body = $request->body;
        $catowner->lat_long = $request->lat_long;
        $catowner->slug = $slug;
        $catowner->image = $imageName;
        if (isset($request->status)) {
            $catowner->status = true;
        } else {
            $catowner->status = false;
        }
        $catowner->save();

        $users = User::where('role_id', '1')->get();
        Notification::send($users, new NewAuthorCatowner($catowner));
        Toastr::success('Catowner Successfully Saved :)', 'Success');
        return redirect()->route('author.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Catowner  $catowner
     * @return \Illuminate\Http\Response
     */
    public function show(Catowner $catowner)
    {
        return view('author.catowner.show', compact('catowner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Catowner  $catowner
     * @return \Illuminate\Http\Response
     */
    public function edit(Catowner $catowner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Catowner  $catowner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catowner $catowner)
    {
        //
    }

    public function location()
    {
        return view('author.catowner.location');
    }

    public function pending()
    {
        $catowners = Catowner::where('is_approved', false)->get();
        return view('author.catowner.pending', compact('catowners'));
    }

    public function approval($id)
    {

        $catowner = Catowner::findOrFail($id);
        if ($catowner->is_approved == false) {
            $catowner->is_approved = true;
            $catowner->save();
            $catowner->user->notify(new AuthorPostApproved($catowner));

            Toastr::success('Catowner Successfully Approved :)', 'Success');
        } else {
            Toastr::info('This Catowner is already approved', 'Info');
        }
        return redirect()->back();
    }

    // public function delete(Catowner $cat)
    // {

    //     $cat = Cat::where('id', $cat)->firstOrFail();
    //     Toastr::error('You are not authorized to access this cat', 'Error');
    //     return redirect()->back();
    //     $cat->delete();
    //     Toastr::success('Cat Successfully Deleted :)', 'Success');
    //     return redirect()->back();
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Catowner  $catowner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catowner $cat)
    {
        //$cat = \App\Cat::where('id', $cat)->firstOrFail();
        if ($cat->user_id != Auth::id()) {
            Toastr::error('You are not authorized to access this catowner', 'Error');
            return redirect()->back();
        }

        $cat->delete();
        Toastr::success('Catowner Successfully Deleted :)', 'Success');
        return redirect()->back();
    }

    // public function delete_dash(Request $request)
    // {
    //     $selid = $request->selcat;
    //     Toastr::success('Catowner Successfully Deleted :) ' . $selid, 'Success');
    //     //print_r($selid);
    //     $cat_del = Catowner::find($selid);
    //     $cat_del->delete();
    //     return redirect()->back();
    // }
    
}
