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
            ->get()            
        ]);
        
    }

}
