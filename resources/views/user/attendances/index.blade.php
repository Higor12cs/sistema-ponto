@extends('layouts.app')

@section('content')
    <h4 class="mb-4">Pontos</h4>

    <x-alerts />

    <div class="alert alert-primary alert-dismissible fade show pb-0" role="alert">
        <p><span class="fw-bold">Ajuda:</span> Clique na linha do ponto desejado para começar a preenche-lo.</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            {{ __('Pontos') }}
        </div>
        <div class="card-body">
            @livewire('user.attendance.attendances-table')
        </div>
    </div>
@endsection
