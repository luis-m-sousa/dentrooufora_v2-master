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
    public function store(Request $request) {

        $obj            = new Candidato();
        $obj->nome  = $request->nome ;

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $requestImage = $request->foto;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/candidatos'), $imageName); 
            $obj->foto = $imageName;
        }
        
        $obj->save();

        return redirect()->route('candidato.index');
    }
    public function edit(Request $request, $id)
    {
        $candidato = Candidato::findOrFail($id);
        return view('candidato.edit', ['candidato' => $candidato]);
    }  
    public function update(Request $request, $id) {

        $validated = $request->validate([
            'nome' =>'required|max:80'
        ]);
        $obj            = Candidato::findOrFail($id);
        $obj->nome      = $request->nome;

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $requestImage = $request->foto;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/candidatos'), $imageName); 
            $obj->foto = $imageName;
        }
        $obj->save();

        return redirect()->route('candidato.index');
    }
    public function delete(Request $request, $id){
        $obj = Candidato::findOrFail($id);
        $obj->delete();

        return redirect()->route('candidato.index');
    }
}
