@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Usuários</h4>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Cadastrar</a>
    </div>

    <x-alerts />

    <div class="card mb-4">
        <div class="card-header">
            {{ __('Usuários') }}
        </div>
        <div class="card-body">
            @livewire('admin.users.users-table')
        </div>
    </div>
@endsection
