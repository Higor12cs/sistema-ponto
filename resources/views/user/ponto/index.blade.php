@extends('layouts.app')

@section('content')
    <h4 class="mb-4">Pontos</h4>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Pontos') }}
        </div>
        <div class="card-body">
            @livewire('user.ponto.pontos-table')
        </div>
    </div>
@endsection
