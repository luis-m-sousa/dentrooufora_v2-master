@extends('layouts.app');

@section('content')

<div class="container px-4">
    <div class="mb-3">
        <a href="{{ route('categoria.create') }}">
            <button class="btn btn-sm btn-success">Nova categoria</button>
        </a>
    </div>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th width="160">Ações</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id }}</td>
                <td>{{ $categoria->nome }}</td>
                <td>
                    <a href="{{ route('categoria.edit', [$categoria->id]) }}"><button class="btn btn-secondary btn-sm">Editar</button></a>
                    <a href="{{ route('categoria.delete', [$categoria->id]) }}"><button class="btn btn-danger btn-sm">Excluir</button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex">
    {!! $categorias->links() !!}
</div>
@endsection