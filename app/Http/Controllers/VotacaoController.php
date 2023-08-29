<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\CandidatoVotacao;
use App\Models\Votacao;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VotacaoController extends Controller
{
    public function index(Request $request)
    {
        return view('votacao.index', ['votacoes' => Votacao::orderBy('id', 'desc')->paginate(5)]);
    }
    public function create(Request $request)
    {
        return view('votacao.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:80',
            'descricao' => '',
            'foto_capa' => '',
            'categoria_id' => ''

        ]);

        $obj = new Votacao();

        $hash = Str::random(8);
        $obj->codigo = $hash;
        $obj->titulo = $request->titulo;
        $obj->descricao = $request->descricao;

        if ($request->hasFile('foto_capa') && $request->file('foto_capa')->isValid()) {
            $requestImage = $request->foto_capa;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/votacao'), $imageName);
            $obj->foto_capa = $imageName;
        }

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
    public function update(Request $request, $id)
    {
        $votacao = Votacao::findOrFail($id);

        $votacao->titulo = $request->titulo;
        $votacao->descricao = $request->descricao;
        if ($request->hasFile('foto_capa') && $request->file('foto_capa')->isValid()) {
            $requestImage = $request->foto_capa;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/votacao'), $imageName);
            $votacao->foto_capa = $imageName;
        }
        $votacao->categoria_id = $request->categoria_id;
        $votacao->save();

        return redirect()->route('votacao.index');
    }
    public function delete(Request $request, $id)
    {
        $obj = Votacao::findOrFail($id);
        $obj->delete();

        return redirect()->route('votacao.index');
    }

    public function ativaVotacao(Request $request, $codigo){
        $votacao = Votacao::where('codigo', $codigo)->firstOrFail();
        $candidatos = Candidato::all();
        $candidatovotacaos = CandidatoVotacao::all();

        if($votacao->publica == 1){
        return view('votacao.show', [
            'votacao' => $votacao,
            'candidatos' => $candidatos,
            'candidatovotacaos' => $candidatovotacaos
        ]);
            }
        else{
            abort(404);
            }
    }
}
