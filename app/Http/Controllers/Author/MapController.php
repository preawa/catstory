<?php

namespace App\Http\Controllers\Author;

use App\Map;
use App\User;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewAuthorMap;
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
        $maps = Auth::User()->maps()->latest()->get();
        return view('author.map.index', compact('maps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.map.create');
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
            'title' => 'required',
            'address_address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $map = new Map();
        $map->user_id = Auth::id();
        $map->title = $request->title;
        $map->address_address = $request->address_address;
        $map->latitude = $request->latitude;
        $map->longitude = $request->longitude;
        $map->save();


        $users = User::where('role_id', '1')->get();
        Notification::send($users, new NewAuthorMap($map));
        Toastr::success('Map Successfully Saved :)', 'Success');
        return redirect()->route('author.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function show(Map $map)
    {
        // $map = Map::find($map);
        return $map;
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
        Toastr::success('Map Successfully Deleted :)', 'Success');
        return redirect()->route('author.dashboard');
    }
}
