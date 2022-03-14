<?php

namespace App\Http\Controllers\Admin;

use App\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = Form::latest()->paginate(5);
        return view('admin.form.index', compact('forms'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.form.create');
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
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'descript' => 'required',
        ]);

        // $form = new Form();
        // $form->name = $request->name;

        Form::create($request->all());

        return redirect()->route('admin.form.index')
            ->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        return view('admin.form.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        return view('admin.form.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'descript' => 'required',
        ]);

        $form->update($request->all());

        return redirect()->route('admin.form.index')
            ->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้.');
    }

    // public function pending()
    // {
    //     $forms = Form::where('is_approved', false)->get();
    //     return view('admin.form.pending', compact('forms'));
    // }

    // public function approval($id)
    // {
    //     $form = Form::find($id);
    //     if ($form->is_approved == false) {
    //         $form->is_approved = true;
    //         $form->save();
    //         $form->user->notify(new AuthorPostApproved($form));

    //         Toastr::success('Form Successfully Approved :)', 'Success');
    //     } else {
    //         Toastr::info('This Form is already approved', 'Info');
    //     }
    //     return redirect()->back();
    // }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('admin.form.index');
    }
}
