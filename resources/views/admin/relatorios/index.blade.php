@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Relatórios</h4>
        <div class="d-flex">
        </div>
    </div>

    <x-alerts />

    <div class="card mb-4">
        <div class="card-header">
            {{ __('Relatórios') }}
        </div>
        <div class="card-body">
            <span>Relatorios</span>
        </div>
    </div>
@endsection
