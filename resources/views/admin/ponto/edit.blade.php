@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>{{ __('Editar Ponto') }} - {{ $ponto->id }}</h4>
        <div class="d-flex">
            <form action="{{ route('admin.pontos.destroy', $ponto) }}" method="POST" class="me-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
            <a href="{{ route('admin.pontos.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

    @livewire('admin.ponto.adicionar-funcionario-ponto', ['ponto' => $ponto])

    <div class="card mb-4">
        <div class="card-header">
            {{ __('Ponto Detalhado') }}
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-8">
                    <label class="form-label">Responsável</label>
                    <input type="text" class="form-control" value="{{ $ponto->user->name }}" disabled>
                </div>
                <div class="col-4">
                    <label class="form-label">Data</label>
                    <input type="text" class="form-control" value="{{ $ponto->data->format('d/m/Y') }}" disabled>
                </div>
            </div>

            @livewire('admin.ponto.ponto-detalhe-table', ['ponto' => $ponto], key($ponto->id))
        </div>
    </div>
@endsection
