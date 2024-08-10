<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceArchive;
use Illuminate\Http\Request;

class InvoiceArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoice::onlyTrashed()->get();
        return view('Invoices.Archive_Invoices',compact('invoices'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoiceArchive  $invoiceArchive
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceArchive $invoiceArchive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvoiceArchive  $invoiceArchive
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceArchive $invoiceArchive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvoiceArchive  $invoiceArchive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id=$request->invoice_id;
        $flight=Invoice::withTrashed()->where('id',$id)->restore();
        session()->flash('restore','get restored');
     return   redirect('/invoices');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoiceArchive  $invoiceArchive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $invoice= Invoice::withTrashed()->where('id',$request->invoice_id)->first();
      $invoice->forceDelete();
      session()->flash('deleted','deletes succ');
    return  redirect('/Archive');

    }
}
