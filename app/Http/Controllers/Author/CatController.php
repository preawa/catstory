<?php

namespace App\Http\Controllers\Author;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AuthorPostApproved;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\User;
use App\booking;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Notifications\NewAuthorCatowner;
use App\Cat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Owner_save;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cats = Auth::User()->cats()->latest()->get();
        $cats = Cat::latest()->get();
        return view('author.dashboard', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'latitude' => 'required',
            'longitude' => 'required',
            'image' => 'required',
        ]);
        $image = $request->file('image');
        if (isset($image)) {
            //            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('cat')) {
                Storage::disk('public')->makeDirectory('cat');
            }

            $catImage = Image::make($image)->resize(1600, 1066)->stream();
            Storage::disk('public')->put('cat/' . $imageName, $catImage);
        } else {
            $imageName = "default.png";
        }

        $cat = new Cat();
        $cat->user_id = Auth::id();
        $cat->name = $request->name;
        $cat->body = $request->body;
        $cat->latitude = $request->latitude;
        $cat->longitude = $request->longitude;
        $cat->image = $imageName;
        $cat->is_approved = false;
        $cat->save();


        // $users = User::where('role_id', '1')->get();
        // Notification::send($users, new NewAuthorCatowner($cat));
        Toastr::success('Cat Successfully Saved :)', 'Success');
        return redirect()->route('author.dashboard');
    }

    public function populatecats($cat)
    {
        $cats = Cat::all();
        return view('author.catowner.show', compact('cats'));
    }


    public function duplicate(Request $request)
    {
        $request->validate([
            'cat_id' => 'required',
            'selcat_id'  => 'required'
        ]);

        $own = new Owner_save();
        $own->cat_id = $request->cat_id;
        $own->cat_by = $request->cat_id;
        $own->report_by = Auth::id();
        $own->save();
        return redirect()->back();
        //return view('author.catowner.show');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function show($cat)
    {

        $cats = Cat::where('id', $cat)->get();
        $allcats = Cat::where('id', '!=', $cat)->get();
        return view('author.catowner.show', compact('cats', 'allcats'));
        // return $cat;
        // return view('author.catowner.show', compact('cats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function edit(Cat $cat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cat $cat)
    {
        //
    }

    public function location()
    {
        return view('author.catowner.location');
    }

    public function booking($catId)
    {
        $bk = new booking();
        $bk->user_id = Auth::id();
        $bk->cat_id = $catId;
        $bk->save();
        $cats = Cat::find($catId);
        $cats->status = 1;
        $cats->save();
        return redirect()->back();
    }

    // public function delete(Cat $cat)
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
     * @param  \App\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cat $cat)
    {


        if ($cat->user_id != Auth::id()) {
            Toastr::error('You are not authorized to access this cat', 'Error');
            return redirect()->back();
        }

        $cat->delete();
        Toastr::success('Cat Successfully Deleted :)', 'Success');
        return redirect()->back();
    }

    public function delete_duplicate(Request $request)
    {
        $selid = $request->selcat;
        Toastr::success('Cat Successfully Deleted :) ' . $selid, 'Success');
        //print_r($selid);
        $cat_del = Cat::find($selid);
        $cat_del->delete();
        return redirect()->back();
    }
}