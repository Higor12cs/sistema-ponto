@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Pontos</h4>
        <a href="{{ route('admin.pontos.create') }}" class="btn btn-primary">Criar Ponto</a>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Pontos') }}
        </div>
        <div class="card-body">
            @livewire('admin.ponto.pontos-table')
        </div>
    </div>
@endsection
