<?php

namespace App\Http\Controllers;

use App\invoices;
use App\invoices_attachments;
use App\invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = invoices::where('id',$id)->first();
        $invoices_details = invoices_details::where('id_invoice',$id)->get();
        $attachments = invoices_attachments::where('id_attachment',$id)->get();
        return view('invoices.details_invoice' ,compact('invoice','invoices_details','attachments'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // $attachments =  invoices_attachments::findOrFail($request->id_file);
        // $attachments->delete();
        Storage::disk('upload_invoices')->delete( '/'.$request->invoice_number.'/'. $request->file_name);
        session()->flash('delete','تم حذف المرفق');
        return back();
    }
    public function open_file($inv_number , $file_name)
    {
        
          
            $files = public_path('Attachments' . '/' . $inv_number . '/' . $file_name);
            return response()->file($files);
       
    }
    public function get_file($inv_number , $file_name)
    {
          
            $files = public_path('Attachments' . '/' . $inv_number . '/' . $file_name);
            return response()->download($files);
        
    }
}
