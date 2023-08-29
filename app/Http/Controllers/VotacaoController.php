<?php

namespace App\Http\Controllers;

use App\Models\Votacao;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VotacaoController extends Controller
{
    public function index (Request $request){
        return view('votacao.index', ['votacoes' => Votacao::orderBy('id', 'desc')->paginate(5)]);
    }
    public function create(Request $request)
    {
        return view('votacao.create');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'titulo' => 'required|max:80',
            'descricao' => '',
            'foto_capa' => '',
            'categoria_id' => ''
            
        ]);

        $obj = new Votacao();

        $hash = substr(Hash::make(uniqid()), 0, 8);
        $obj->codigo = $hash;
        $obj->titulo = $request->titulo;
        $obj->descricao = $request->descricao;
        $obj->foto_capa = $request->foto_capa;
        $obj->datahora_inicio = Carbon::now(); 
        $obj->categoria_id = $request->categoria_id;
        $obj->publica = 1;

        $usuario_id = Auth::id();
        $obj->usuario_id = $usuario_id;
        
        $obj->save();


        return redirect()->route('votacao.index');
    }
    public function edit(Request $request, $id)
    {
        $votacao = Votacao::findOrFail($id);
        return view('votacao.edit', ['votacao' => $votacao]);
    }
    public function update(Request $request, $id){
        $votacao = Votacao::findOrFail($id);

        $votacao->titulo = $request->titulo;
        $votacao->descricao = $request->descricao;
        $votacao->foto_capa = $request->foto_capa;
        $votacao->categoria_id = $request->categoria_id;
        $votacao->save();

       return redirect()->route('votacao.index');
    }
    public function delete(Request $request, $id){
        $obj = Votacao::findOrFail($id);
        $obj->delete();

        return redirect()->route('votacao.index');
    }

    public function ativaVotacao(Request $request, $codigo){
        $votacao = Votacao::where('codigo', $codigo)->firstOrFail();

        if($votacao->publica == 1){
        return view('votacao.show', compact('votacao'));   
        }
        else{
            abort(404);
            }
    }
}
