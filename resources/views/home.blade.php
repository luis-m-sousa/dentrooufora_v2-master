@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <button class="btn btn-primary"><a href="/candidato" style="text-decoration: none; color: white">Candidatos</a></button>
                        <button class="btn btn-success"><a href="/categoria" style="text-decoration: none; color: white">Categorias</a></button>
                        <button class="btn btn-danger"><a href="/votacao" style="text-decoration: none; color: white">Votações</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
