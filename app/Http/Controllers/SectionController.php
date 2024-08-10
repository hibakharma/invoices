<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return Section::get();
        return view('sections.sections',[
            'sections' => Section::get()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData=$request->validate(
            [
           'section_name' =>'required|unique:sections|max:255',
            'description' =>'required',
        ],
            [
                'section_name.required'=>'يرجى ادخال اسم القسم',
                'section_name.unique' => 'اسم القسم مستخدم مسبقا',
                'description.required' => 'يرجى ادخال وصف القسم',
            ]
        );

     section::create([
         'section_name'=>$request->section_name,
         'description' =>$request->description,
         'created_by' => Auth::user()->name
     ]);
     return view('sections.sections')->with(['sections'=>section::get()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
       $validateData=$request->validate(
           [
               'section_name'=>'required|unique:sections,section_name,'.$request->id,
               'description' => 'required',

       ],
       [
           'section_name.required'=>'يرجى ادخال اسم القسم',
     'section_name.unique'=>'اسم القسم موجود مسبقا',
     'description.required'=>'يرجى ادخال وصف القسم',

       ]);
$section= Section::find($request->id);
      $section->update([
           'section_name'=>$request->section_name,
           'description' => $request->description,
       ]);
       session()->flash('edit');
       return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,Section $section)
    {
        $section=Section::findorfail($request->id);
        $section->delete();
        session()->flash('delete','تم الحذف بنجاح');
        return redirect('/sections');
    }
}
