<?php

namespace App\Http\Controllers\Admin;

use App\Map;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maps = Map::latest()->get();
        return view('admin.map.index', compact('maps'));
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
            'address_address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $map = new Map();
        $map->user_id = Auth::id();
        $map->address_address = $request->address_address;
        $map->latitude = $request->latitude;
        $map->longitude = $request->longitude;
        $map->is_approved = true;
        $map->save();
        // Map::create($request->all());

        return redirect()->route('admin.map.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function show(Map $map)
    {
        return view('admin.map.show', compact('map'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function edit(Map $map)
    {
        //
    }

    public function pending()
    {
        $maps = Map::where('is_approved', false)->get();
        return view('admin.map.pending', compact('maps'));
    }
    
    public function approval($id)
    {
        $map = Map::findOrFail($id);
        if ($map->is_approved == false) {
            $map->is_approved = true;
            $map->save();
            $map->user->notify(new AuthorPostApproved($map));

            Toastr::success('Map Successfully Approved :)', 'Success');
        } else {
            Toastr::info('This Map is already approved', 'Info');
        }
        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Map $map)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map $map)
    {
        $map->delete();
        return redirect()->route('admin.map.index');
    }
}
