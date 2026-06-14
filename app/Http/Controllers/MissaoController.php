<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use App\Models\Corpo;
use App\Models\Astronauta;
use App\Models\Missao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreMissaoRequest;   

class MissaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $missoes = Missao::with('corpo')->get();
        return view('missoes.index', compact('missoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $corpos = Corpo::all();
        $astronautas = Astronauta::all();
        $missoes = Missao::all();
        return view('missoes.create', compact('missoes', 'astronautas', 'corpos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMissaoRequest $request)
    {
        $dados = $request->validated();

            if ($request->hasFile('fotos') && $request->file('fotos')->isValid()) {
            $fotos= $request->file('fotos')->store('fotos', 'public');
            $dados['fotos'] = $fotos;
            }
               
        $missao = Missao::create($dados);
        if ($request->has('astronautas')) {
            $missao->astronautas()->attach($request->input('astronautas'));
        
        }

        
            
        
        
        return redirect()->route('missoes.index')->with('sucesso', 'Missao criada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Missao $missao)
    {
        return view('missoes.show', compact('missao'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Missao $missao)
    {
        $corpos = Corpo::all();
        $astronautas = Astronauta::all();
        return view('missoes.edit', compact('missao', 'corpos', 'astronautas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMissaoRequest $request, Missao $missao)
    {
        $dados = $request->validated();
            if ($request->hasFile('fotos') && $request->file('fotos')->isValid()) {
                if ($missao->fotos) {
                    Storage::disk('public')->delete($missao->fotos);
                }
                $fotos= $request->file('fotos')->store('fotos', 'public');
                $dados['fotos'] = $fotos;
            }
        $missao->update($dados);
        
        if ($request->has('astronautas')) {
            $missao->astronautas()->sync($request->input('astronautas'));
        } else {
            $missao->astronautas()->detach();
        }
        return redirect()->route('missoes.index')->with('sucesso', 'Missao atualizada');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Missao $missao)
    {
        
         if ($missao->fotos) {
            Storage::disk('public')->delete($missao->fotos);
        }
        
        $missao->astronautas()->detach();
        $missao->delete();
        return redirect()->route('missoes.index')->with('sucesso', 'Missão excluída');
    }
}
