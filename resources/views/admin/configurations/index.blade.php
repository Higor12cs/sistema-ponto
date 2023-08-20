@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>{{ __('Configurações') }}</h4>
        <div class="d-flex">
        </div>
    </div>

    <x-alerts />

    <div class="card mb-4">
        <div class="card-header">
            {{ __('Configurações') }}
        </div>
        <div class="card-body">

            <p class="fw-bold">{{ __('Data limite de pontos') }}</p>

            <p>Os responsáveis poderão ver pontos de até quantos dias atrás?</p>

            <form action="{{ route('admin.configuration.set-user-attendance-display-limit') }}" method="POST">
                @csrf

                <div class="input-group input-group mb-3">
                    <span class="input-group-text">Dias</span>
                    <input type="number" class="form-control" name="number-of-days" value="{{ $userAttendanceDisplayLimit->value }}">
                </div>

                <button type="submit" class="btn btn-primary">Salvar</button>

            </form>
            
        </div>
    </div>
@endsection
