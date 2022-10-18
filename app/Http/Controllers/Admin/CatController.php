<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AuthorPostApproved;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Notifications\NewAuthorCatowner;
use App\Cat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Cat::latest()->get();
        return view('admin.map.index', compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.map.create');
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
        $cat->is_approved = true;
        $cat->save();


        Toastr::success('Cat Successfully Saved :)', 'Success');
        return redirect()->route('admin.map.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function show($cat)
    {
        // if ($cat->user_id != Auth::id()) {
        //     Toastr::error('You are not authorized to access this cat', 'Error');
        //     return redirect()->back();
        // }
        $cats = Cat::where('id', $cat)->get();
        return view('admin.map.show', compact('cats'));
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

    public function pending()
    {
        $cats = Cat::where('is_approved', false)->get();
        return view('admin.map.index', compact('cats'));
    }

    public function approval($id)
    {
        $cat = Cat::find($id);
        if ($cat->is_approved == false) {
            $cat->is_approved = true;
            $cat->save();
            $cat->user->notify(new AuthorPostApproved($cat));

            Toastr::success('Cat Successfully Approved :)', 'Success');
        } else {
            Toastr::info('This Cat is already approved', 'Info');
        }
        return redirect()->back();
    }

    public function location()
    {
        return view('admin.map.location');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cat  $cat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cat $cat)
    {
        //
    }
}
