@extends('layouts.app');

@section('content')

<div class="container px-4">
    <div class="mb-3">
        <a href="{{ route('votacao.create') }}">
            <button class="btn btn-sm btn-success">Nova Votação</button>
        </a>
    </div>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Código</th>
            <th scope="col">Título</th>
            <th scope="col">Descrição</th>
            <th scope="col">ID da Categoria</th>
            <th scope="col">Pública</th>
            <th width="160">Ações</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($votacoes as $votacao)
            <tr>
                <td>{{ $votacao->id }}</td>
                <td>{{ $votacao->codigo }}</td>
                <td>{{ $votacao->titulo }}</td>
                <td>{{ $votacao->descricao }}</td>
                <td>{{ $votacao->categoria_id }}</td>
                <td>
                @if($votacao->publica == 0)
                    Não
                @else
                    Sim
                
                @endif    
            </td>
                <td>
                    <a href="{{ route('votacao.edit', [$votacao->id]) }}"><button class="btn btn-secondary btn-sm">Editar</button></a>
                    <a href="{{ route('votacao.delete', [$votacao->id]) }}"><button class="btn btn-danger btn-sm">Excluir</button></a>
                </td>
            </tr>
            @endforeach
        </tbody>    
    </table>
</div>

<div class="d-flex">
    {!! $votacoes->links() !!}
</div>
@endsection