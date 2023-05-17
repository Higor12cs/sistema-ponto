@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Preencher Ponto</h4>
        <a href="{{ route('pontos.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Preencher') }}
        </div>
        <div class="card-body">
            @livewire('user.ponto.preencher-ponto-table', ['ponto' => $ponto])
        </div>
    </div>

    @livewire('user.ponto.preencher-ponto-modal')
@endsection
