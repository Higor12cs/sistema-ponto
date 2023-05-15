@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Funcionários</h4>
        <a href="{{ route('admin.funcionarios.create') }}" class="btn btn-primary">Cadastrar</a>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Funcionários') }}
        </div>
        <div class="card-body">
            @livewire('admin.funcionario.funcionarios-table')
        </div>
    </div>
@endsection
