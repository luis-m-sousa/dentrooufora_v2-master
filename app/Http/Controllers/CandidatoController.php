<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    public function index (Request $request){
        return view('candidato.index', ['candidatos' => Candidato::orderBy('id', 'desc')->paginate(5)]);
    }
    public function create(Request $request)
    {
        return view('candidato.create');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'nome' => 'required|max:100',
            'foto' => '',
        ]);

        $obj = new Candidato();
        $obj->nome = $request->nome;
        $obj->foto = $request->foto;
        $obj->save();

        return redirect()->route('candidato.index');
    }
    public function edit(Request $request, $id)
    {
        $candidato = Candidato::findOrFail($id);
        return view('candidato.edit', ['candidato' => $candidato]);
    }
    public function update(Request $request, $id){
        $candidato = Candidato::findOrFail($id);

        $candidato->nome = $request->nome;
        $candidato->foto = $request->foto;
        $candidato->save();

       return redirect()->route('candidato.index');
    }
    public function delete(Request $request, $id){
        $obj = Candidato::findOrFail($id);
        $obj->delete();

        return redirect()->route('candidato.index');
    }
}
