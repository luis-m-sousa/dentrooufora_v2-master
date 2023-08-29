@extends('layouts.app');

@section('content')

<div class="container px-4">
    <div class="mb-3">
        <a href="{{ route('candidato.create') }}">
            <button class="btn btn-sm btn-success">Novo Candidato</button>
        </a>
    </div>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Foto</th>
            <th width="160">Ações</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($candidatos as $candidato)
            <tr>
                <td>{{ $candidato->id }}</td>
                <td>{{ $candidato->nome }}</td>
                <td><img src="/img/candidatos/{{$candidato->foto}}" alt="foto do candidato {{$candidato->nome}}" style="width: 100px"></td>
                <td>
                    <a href="{{ route('candidato.edit', [$candidato->id]) }}"><button class="btn btn-secondary btn-sm">Editar</button></a>
                    <a href="{{ route('candidato.delete', [$candidato->id]) }}"><button class="btn btn-danger btn-sm">Excluir</button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex">
    {!! $candidatos->links() !!}
</div>
@endsection