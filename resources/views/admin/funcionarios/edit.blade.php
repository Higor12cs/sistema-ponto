@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Editar Funcionário</h4>
        <a href="{{ route('admin.funcionarios.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Editar Funcionário') }}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.funcionarios.update', $funcionario->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="id" class="form-label">Código</label>
                        <input type="text" class="form-control" id="id" name="id"
                            value="{{ $funcionario->id }}" disabled>
                    </div>
                    <div class="col-8">
                        <label for="matricula" class="form-label">Matrícula</label>
                        <input type="text" class="form-control @if ($errors->has('matricula')) is-invalid @endif"
                            id="matricula" name="matricula" placeholder="ABC123"
                            value="{{ old('matricula', $funcionario->matricula ?? '') }}">
                        @if ($errors->has('matricula'))
                            <div class="invalid-feedback">
                                {{ $errors->first('matricula') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control @if ($errors->has('nome')) is-invalid @endif"
                        id="nome" name="nome" placeholder="João da Silva"
                        value="{{ old('nome', $funcionario->nome ?? '') }}">
                    @if ($errors->has('nome'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nome') }}
                        </div>
                    @endif
                </div>
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
