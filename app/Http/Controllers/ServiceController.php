<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            
        return Inertia::render('Services', [
            'services' => Service::when($request->term,function($query,$term)
            {
                $query->where('description' , 'LIKE','%'.$term.'%');
            })->paginate(),
            "searched" =>  $request->term       
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
        
        $request->validate([
            'description' => 'required',
            'price' => 'required',
            'type' => 'required',
        ]);

        $Service = Service::create([
            'description' => $request->description,
            'price' => $request->price,
            'type' => $request->type,
        ]);

      
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

        
       
        $request->validate([
            'description' => 'required',
            'price' => 'required',
            'type' => 'required'
          ]);
          // Actualizar el usuario en la base de datos
            $id =  $request->all('id');
            Service::where('id',$id )->update($request->all('description','price','type'));                   
             
            // Devolver una respuesta exitosa
            //   return Redirect::to('/services/edit/'.$id);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Service::destroy($request->all('idServiceDelete'));
        return Redirect::to('/services');
    }
}
