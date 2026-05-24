<?php

namespace App\Http\Controllers;

use App\Models\Astronauta;
use Illuminate\Http\Request;

class AstronautaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Astronautas = Astronauta::all();
        return view('astronautas.index', compact('Astronautas')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Astronauta $astronauta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Astronauta $astronauta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Astronauta $astronauta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Astronauta $astronauta)
    {
        //
    }
}
