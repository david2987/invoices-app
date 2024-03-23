<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            
        return Inertia::render('Services', [        
            'services' =>  DB::table('services')
            ->when($request->term,function($query,$term){
                $query->where('description' , 'LIKE','%'.$term.'%'); 
            })
            ->when($request->type,function($query,$type){
                $query->where('type',$type); 
            })
            ->get(),
            "searched" =>  $request->term,
            "searchType" => $request->type       
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        return Inertia::render('Services/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    try{  
        $request->validate([
            'description' => 'required',
            'price' => 'required|decimal:0,99999',
            'type' => 'required',
        ]);
                

        Service::create([
            'description' => $request->description,
            'price' => $request->price,
            'type' => $request->type,
        ]);

    } catch (\Throwable $error) {
        return $error;
    }   
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service , $id = 0)
    {
        $services = Service::where('id',$id)->get();            
        return Inertia::render('Services/Edit', [
            'services' => response($services)            
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

    try{
         $request->validate([
            'description' => 'required',
            'price' => 'required|decimal:0,99999',
            'type' => 'required'
          ]);

          // Actualizar el usuario en la base de datos
            $id =  $request->all('id');
            Service::where('id',$id )->update($request->all('description','price','type'));                   
        } catch (\Throwable $error) {
            return $error;
        }     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Clean Consumptions with this service
        DB::table('consumptions')->where('service_id',$request->idServiceDelete)->delete();


        Service::destroy($request->all('idServiceDelete'));
        return Redirect::to('/services');
    }
}
