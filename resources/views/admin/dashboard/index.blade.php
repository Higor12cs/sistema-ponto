@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-betwewen mb-4">
        <h4>{{ __('Dashboard') }}</h4>
    </div>

    <x-alerts />

    <div class="card mb-4">
        <div class="card-header">
            {{ __('Admin Dashboard') }}
        </div>
        <div class="card-body">
            {{ __('Bem-vindo!') }}
        </div>
    </div>
@endsection
