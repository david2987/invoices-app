<?php

namespace App\Http\Controllers;

use App\Models\Consumption;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


class ConsumptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        
        return Inertia::render('Consumptions/Consumption', [        
            'consumptions' =>  DB::table('consumptions')
            ->join('services', 'services.id', '=', 'consumptions.service_id')
            ->where('consumptions.invoice_id',$id)
            // ->when($id,function($query,$invoiceId){
            //     $query->where('invoice_id' , $invoiceId); 
            // })
            // // ->when($request->type,function($query,$type){
            // //     $query->where('type',$type); 
            // })
            ->get()
            // "searched" =>  $request->term,
            // "searchType" => $request->type       
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($rows,$invoiceId)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Consumption $consumption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consumption $consumption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consumption $consumption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consumption $consumption)
    {
        //
    }
}
