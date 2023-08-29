<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Votação: {{$votacao->titulo}}</title>
</head>
<body>
    <h1>Bem-vindo à votação: {{$votacao->titulo}}</h1>

    <form action="processar_voto" method="GET">
        @csrf
        <div class="row mt-4">

            @php
                $previousRow = -1;
            @endphp

            @foreach ($candidatovotacaos as $index => $candidatovotacao)
                @if ($candidatovotacao->votacao_id == $votacao->id)
                    @if ($previousRow !== floor($index / 2))
                        @php
                            $previousRow = floor($index / 2);
                        @endphp
                        <div class="w-100"></div>
                    @endif
                    <div class="col-md-6">
                        <div class="card mb-4 candidato">
                            <img src="/img/candidatos/{{$candidato->foto}}"
                                alt="{{ $candidatovotacao->candidato->nome }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $candidatovotacao->candidato->nome }}</h5>
                                <input type="radio" name="candidato_linha{{ $previousRow }}"
                                    value="{{ $candidatovotacao->candidato->id }}">
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>

    </form>
</body>
</html>
