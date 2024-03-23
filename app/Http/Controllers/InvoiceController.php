<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Service;
use App\Models\Consumption;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        return Inertia::render('Invoices', [
            'invoices' =>  DB::table('invoices')
                ->when($request->term, function ($query, $term) {
                    $query->where('number', $term);
                })
                ->when($request->from, function ($query, $from) {
                    $query->where('date', '>=', $from);
                })
                ->when($request->to, function ($query, $to) {
                    $query->where('date', '<=', $to);
                })
                ->get(),
            "searched" =>  $request->term,
            "from" => $request->from,
            "to" => $request->to
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // get Services
        $services = Service::all('*');

        return Inertia::render('Invoices/Create', [
            'services' => response($services)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $request->validate([
                'number' => 'required|integer',
                'client' => 'required',
                'date'   => 'required|date',
                'total'  => 'required|decimal:0,999999999999',
            ]);

            $Invoice = Invoice::create([
                'number' => $request->number,
                'client' => $request->client,
                'date'   => $request->date,
                'total'  => $request->total,
                'paymentOptions' => 'cash',
                'state' => 'pending'
            ]);

            // Fetch the newly created invoice's ID
            $invoiceId = $Invoice->fresh()->id;

            if ($invoiceId) {

                $i = 1; // indice
                foreach ($request->rows as $row) {

                    if ($this->validateDetail($row)) {
                        Consumption::create([
                            "item" => $i,
                            "invoice_id" =>  $invoiceId,
                            'service_id' => $row['service'],
                            "unit" => $row['unit'],
                            "price" => $row['price'],
                            "subtotal" => $row['total'],
                            "period" => $row['period']
                        ]);
                        $i++;
                    }else{
                        throw new Exception('Error En Valores de la grilla');
                    }
                }
            }
        } catch (\Throwable $error) {
            return $error->getMessage();
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice, $id = 0)
    {
        $services = Service::all('*');
        $invoices = Invoice::where('id', $id)->get();
        $consumptions = Consumption::where('invoice_id', $id)->get();

        return Inertia::render('Invoices/Edit', [
            'invoices' => response($invoices),
            'services' => response($services),
            'consumptions' => response($consumptions),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $InvoiceId =  $request->InvoiceId;

        try {

            $request->validate([
                'number' => 'required|integer',
                'client' => 'required',
                'date'   => 'required|date',
                'total'  => 'required|decimal:0,999999999999',
            ]);

            // Update Invoice
            Invoice::where('id', $InvoiceId)->update(
                $request->all('number', 'client', 'date', 'total')
            );
            $i = 1; // index

            // Clean Consumptions
            DB::table('consumptions')->where('invoice_id',$InvoiceId)->delete();

            foreach ($request->rows as  $row) {

                if ($this->validateDetail($row)) {
                    Consumption::where('invoice_id', $InvoiceId)
                    ->where("item", $i)
                    ->create([
                        "item" => $i,
                        "invoice_id" =>  $InvoiceId,
                        'service_id' => $row['service'],
                        "unit" =>       $row['unit'],
                        "price" =>      $row['price'],
                        "subtotal" =>   $row['total'],
                        "period" =>     $row['period']
                        ]);
                    $i++;
                }
            }
        } catch (\Throwable $error) {
            return $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Clean Consumptions
        DB::table('consumptions')->where('invoice_id',$request->idInvoiceDelete)->delete();

        // delete invoice
        Invoice::destroy($request->all('idInvoiceDelete'));
        return Redirect::to('/invoices');
    }


    /**
     * Validate the specified detail.
     */
    private function validateDetail($consumptions)
    {

        foreach ($consumptions as $consumption) {

            
            if (isset($consumption['unit'])) {
                return false;
            }

            if (isset($consumption['service'])) {
                return false;
            }

            if (isset($consumption['price'])) {
                return false;
            }

            if (isset($consumption['total'])) {
                return false;
            }

            if (isset($consumption['period'])) {
                return false;
            }

            return true;
        }
    }
}
