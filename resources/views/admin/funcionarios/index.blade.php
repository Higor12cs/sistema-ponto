@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Funcionários</h4>
        <a href="{{ route('admin.funcionarios.create') }}" class="btn btn-primary">Cadastrar</a>
    </div>

    <x-alerts />

    <div class="card mb-4">
        <div class="card-header">
            {{ __('Funcionários') }}
        </div>
        <div class="card-body">
            @livewire('admin.funcionario.funcionarios-table')
        </div>
    </div>
@endsection
