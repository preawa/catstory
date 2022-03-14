<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\User;
use App\Notifications\AuthorPostApproved;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Catowner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatownerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catowners = Catowner::latest()->get();
        return view('admin.catowner.index', compact('catowners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catowner.create');
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
            'address_address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'image' => 'required',

        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)) {
            //            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('catowner')) {
                Storage::disk('public')->makeDirectory('catowner');
            }

            $catownerImage = Image::make($image)->resize(1600, 1066)->stream();
            Storage::disk('public')->put('catowner/' . $imageName, $catownerImage);
        } else {
            $imageName = "default.png";
        }

        $catowner = new Catowner();
        $catowner->user_id = Auth::id();
        $catowner->name = $request->name;
        $catowner->body = $request->body;
        $catowner->address_address = $request->address_address;
        $catowner->latitude = $request->latitude;
        $catowner->longitude = $request->longitude;
        $catowner->slug = $slug;
        $catowner->image = $imageName;
        if (isset($request->status)) {
            $catowner->status = true;
        } else {
            $catowner->status = false;
        }
        $catowner->is_approved = true;
        $catowner->save();

       
        Toastr::success('Catowner Successfully Saved :)', 'Success');
        return redirect()->route('admin.catowner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Catowner  $catowner
     * @return \Illuminate\Http\Response
     */
    public function show(Catowner $catowner)
    {
        return view('admin.catowner.show', compact('catowner'));
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

    public function pending()
    {
        $catowners = Catowner::where('is_approved', false)->get();
        return view('admin.catowner.pending', compact('catowners'));
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Catowner  $catowner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catowner $catowner)
    {
        if ($catowner->user_id != Auth::id()) {
            Toastr::error('You are not authorized to access this catowner', 'Error');
            return redirect()->back();
        }
        if (Storage::disk('public')->exists('catowner/' . $catowner->image)) {
            Storage::disk('public')->delete('catowner/' . $catowner->image);
        }

        $catowner->delete();
        Toastr::success('Catowner Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
