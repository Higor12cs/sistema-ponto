@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Preencher Ponto</h4>
        <a href="{{ route('pontos.index') }}" class="btn btn-secondary">Voltar</a>
    </div>

    <x-alerts />

    <div class="card mb-4">
        <div class="card-header">
            {{ __('Preencher') }}
        </div>
        <div class="card-body">
            @livewire('user.ponto.preencher-ponto-table', ['ponto' => $ponto])

            <form action="{{ route('pontos.close', $ponto) }}" method="POST">
                @csrf
                <button type="submit"
                    onclick="return confirm('Tem certeza que deseja concluir este ponto? Após clicar em ok, este ponto não estará mais disponível para edição.')"
                    class="btn btn-primary">Concluir Ponto</button>
            </form>
        </div>
    </div>

    @livewire('user.ponto.preencher-ponto-modal')
@endsection
