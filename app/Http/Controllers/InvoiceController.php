<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Service;
use App\Models\Consumption;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Route;

class InvoiceController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
                        
        return Inertia::render('Invoices', [
            'invoices' => Invoice::when($request->term,function($query,$term)
            {
                $query->where('number' , 'LIKE','%'.$term.'%');
            })->paginate(),
            "searched" =>  $request->term       
        ]);
    }


    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {                

        // get Services
        $services = Service::all('*');
        
        return Inertia::render('Invoices/Create',[
            'services' => response($services)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'number' => 'required',
            'client' => 'required',
            'date'   => 'required',
            'total'  => 'required',
        ]);
        
        
        return $request->rows;

        $Invoice = Invoice::create([
            'number' => $request->number,
            'client' => $request->client,
            'date'   => $request->date,
            'total'  => $request->total,
        ]);


         Consumption::create([
            "item" => $request->item,
             "invoice_id" => $request->id,
             "unit" => $request->unit,
             "price" =>$request->price,
             "subtotal" =>$request->subtotal,              
         ]);



        return "Guardo Exitosamente";

      
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice , $id = 0)
    {
        
        $invoices = Invoice::where('id',$id)->get();            
        return Inertia::render('Invoices/Edit', [
            'invoices' => response($invoices),        
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {       
        $request->validate([
            'number' => 'required',
            'client' => 'required',
            'date'   => 'required',
            'total'  => 'required',
          ]);
          // Actualizar el usuario en la base de datos
            $id =  $request->all('id');
            Invoice::where('id',$id )->update($request->all('number','client','date','total'));                   
             
            // Devolver una respuesta exitosa
            //   return Redirect::to('/invoices/edit/'.$id);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Invoice::destroy($request->all('idInvoiceDelete'));
        return Redirect::to('/invoices');
    }
}
