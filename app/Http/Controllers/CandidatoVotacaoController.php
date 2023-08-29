<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\CandidatoVotacao;
use App\Models\Votacao;
use Illuminate\Http\Request;

class CandidatoVotacaoController extends Controller
{
    public function index(){
        $candidatovotacao = CandidatoVotacao::all();
        return view('candidatovotacao.index', ['candidatovotacao' => $candidatovotacao]);
    }
    public function create(Request $request) {
        $candidato = Candidato::all();
        $votacao = Votacao::all();
        return view('candidatovotacao.create',['candidato' => $candidato],['votacao' => $votacao]);
    }
    public function store(Request $request) {
        $obj = new CandidatoVotacao();
        $obj->candidato_id = $request->candidato_id;
        $obj->votacao_id = $request->votacao_id;
        $obj->pontos = 0;
        $obj->save();

        return redirect()->route('candidatovotacao.index');
    }
    public function edit(Request $request, $candidato_id, $votacao_id) {
        $candidatovotacao = CandidatoVotacao::find(compact('candidato_id', 'votacao_id'));
        
        $candidato = Candidato::all();
        $votacao = Votacao::all();
        
        return view('candidatovotacao.edit', [
            'candidatovotacao' => $candidatovotacao,
            'candidato' => $candidato,
            'votacao' => $votacao
        ]);
    }
    
    public function update(Request $request, $candidato_id, $votacao_id) {
        $candidatovotacao = CandidatoVotacao::where([
            'candidato_id' => $candidato_id,
            'votacao_id' => $votacao_id
        ])->firstOrFail();
        $candidatovotacao->candidato_id = $request->candidato_id;
        $candidatovotacao->votacao_id = $request->votacao_id;
    
    }
    
    public function delete(Request $request, $candidato_id, $votacao_id) {
        $candidatovotacao = CandidatoVotacao::find(compact('candidato_id', 'votacao_id'));
    
        $candidatovotacao->delete();
    
        return redirect()->route('candidatovotacao.index');
    }
    
    
}
