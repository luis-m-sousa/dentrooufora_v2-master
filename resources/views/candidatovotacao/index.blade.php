@extends('layouts.app');

@section('content')

<div class="container px-4">
    <div class="mb-3">
        <a href="{{ route('candidatovotacao.create') }}">
            <button class="btn btn-sm btn-success">Cadastrar Candidato em Votação</button>
        </a>
    </div>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID votação</th>
            <th scope="col">ID candidato</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($candidatovotacao as $candidatovotacao)
            <tr>
                <td>{{ $candidatovotacao->votacao_id }}</td>
                <td>{{ $candidatovotacao->candidato_id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection