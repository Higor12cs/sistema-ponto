@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Pontos</h4>
        <a href="{{ route('admin.pontos.create') }}" class="btn btn-primary">Criar Ponto</a>
    </div>

    <x-alerts />

    <div class="card mb-4">
        <div class="card-header">
            {{ __('Pontos') }}
        </div>
        <div class="card-body">
            @livewire('admin.ponto.pontos-table')
        </div>
    </div>
@endsection
