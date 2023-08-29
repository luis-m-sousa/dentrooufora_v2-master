<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidatoVotacao extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'candidato_votacao';
    protected $fillable = ['votacao_id', 'candidato_id', 'pontos'];

    public function votos(){
        return $this->belongsTo(CandidatoVotacao::class);
    }
}
