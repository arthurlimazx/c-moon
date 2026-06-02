<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCorpoRequest;
use App\Models\Corpo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CorpoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $corpos = Corpo::all();
        return view('corpos.index', compact('corpos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('corpos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCorpoRequest $request)
    {
        $dados= $request->validated();
         
        
            if ($request->hasFile('fotos') && $request->file('fotos')->isValid()) {
            $fotos= $request->file('fotos')->store('fotos', 'public');
            $dados['fotos'] = $fotos;
            }
        
        Corpo::create($dados);
        
        return redirect()->route('corpos.index')->with('sucesso', 'Corpo criado');

    }

    /**
     * Display the specified resource.
     */
    public function show(Corpo $corpo)
    {

        return view('corpos.show', compact('corpo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Corpo $corpo)
    {
        return view('corpos.edit', compact('corpo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCorpoRequest $request, Corpo $corpo)
    {
        //
        $dados = $request->validated();

            if ($request->hasFile('fotos') && $request->file('fotos')->isValid()) {
                if ($corpo->fotos) {
                    Storage::disk('public')->delete($corpo->fotos);
                }
                $fotos= $request->file('fotos')->store('fotos', 'public');
                $dados['fotos'] = $fotos;
            }
        $corpo->update($dados);
        return redirect()->route('corpos.index')->with('sucesso', 'Corpo atualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Corpo $corpo)
    {
        
         if ($corpo->fotos) {
            Storage::disk('public')->delete($corpo->fotos);
        }
        
        $corpo->delete();
        return redirect()->route('corpos.index')->with('sucesso', 'Corpo apagado');
    }
}
