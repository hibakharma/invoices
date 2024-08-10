<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=Section::get();
        $products=Product::get();
       return view('products.products',compact('products','sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validateData = $request->validate(
            [
                'product_name' => 'required',
                'description' => 'required',
                'section_id' => 'required'

            ],
            [
                'product_name.required' => 'يجب ادخال اسم المنتج',
                'description.required' => 'يجب ادخال وصف المنتج',
            ]
        );

        Product::create([
                'product_name' => $request->product_name,
                'description' => $request->description,
                 'section_id' => $request->section_id
            ]
        );
        session()->flash('Add','تم الاضافة بنجاح');
        return redirect('/products');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $validateData = $request->validate(
            [
                'product_name' => 'required',
                'description' => 'required',
                'section_id' => 'required'

            ],
            [
                'product_name.required' => 'يجب ادخال اسم المنتج',
                'description.required' => 'يجب ادخال وصف المنتج',
            ]
        );
        $product=Product::find($request->id);
        $product->update([
                'product_name' => $request->product_name,
                'description' => $request->description,
                'section_id' => $request->section_id
            ]
        );
        session()->flash('edit','تم التعديل بنجاح');
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , Product $product)
    {
        return $request;
        $products=Product::find($request->id);
        $product->delete();
        session('delete','تم الحذف بنجاح');

    }
}
