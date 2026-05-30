<?php

namespace App\Http\Controllers;
use App\Models\Missao;
use App\Models\Astronauta;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class AstronautaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $astronautas = Astronauta::all();
        return view('astronautas.index', compact('astronautas')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $missoes = Missao::all();
       return view('astronautas.create', compact('missoes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'nacionalidade' => 'required',
            'especialidade' => 'required',
            'num_missoes' => 'required|integer',
            'status' => ['required', Rule::in(['ativo', 'inativo', 'aposentado'])],
            'fotos' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);


        $dados = $request->all();
                if ($request->hasFile('fotos') && $request->file('fotos')->isValid()) {
                $fotos= $request->file('fotos')->store('fotos', 'public');
                $dados['fotos'] = $fotos;
                }

        $astronauta = Astronauta::create($dados);
        if ($request->has('missoes')) {
            $astronauta->missoes()->attach($request->input('missoes'));
        }
            
        return redirect()->route('astronautas.index')->with('sucesso', 'Astronauta criados');
    }

    /**
     * Display the specified resource.
     */
    public function show(Astronauta $astronauta)
    {   
        return view('astronautas.show', compact('astronauta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Astronauta $astronauta)
    {
      
        $missoes = Missao::all();
        return view('astronautas.edit', compact('astronauta', 'missoes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Astronauta $astronauta)
    {
        $request->validate([
            'nome' => 'required',
            'nacionalidade' => 'required',
            'especialidade' => 'required',
            'num_missoes' => 'required|integer',
            'status' => ['required', Rule::in(['ativo', 'inativo', 'aposentado'])],
            'fotos' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);


         $dados = $request->all();
            if ($request->hasFile('fotos') && $request->file('fotos')->isValid()) {
                if ($astronauta->fotos) {
                    Storage::disk('public')->delete($astronauta->fotos);
                }
                $fotos= $request->file('fotos')->store('fotos', 'public');
                $dados['fotos'] = $fotos;
            }
            $astronauta->update($dados);
        if ($request->has('missoes')) {
           $astronauta->missoes()->sync($request->input('missoes'));

        } else {
            $astronauta->missoes()->detach();

        }
        return redirect()->route('astronautas.index')->with('sucesso', 'Astronauta atualizado');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Astronauta $astronauta)
    {
        
        if ($astronauta->fotos) {
            Storage::disk('public')->delete($astronauta->fotos);
        }
        $astronauta->missoes()->detach();
        $astronauta->delete();
        return redirect()->route('astronautas.index')->with('sucesso', 'Astronauta deletado');
    }
}
