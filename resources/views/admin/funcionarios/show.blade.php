@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Visualizar Funcionário</h4>
        <div class="d-flex">
            <form action="{{ route('admin.funcionarios.destroy', $funcionario) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Tem certeza que deseja excluir este funcionário?')" type="submit"
                    class="btn btn-danger me-1">Excluir</button>
            </form>
            <a href="{{ route('admin.funcionarios.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Visualizar Funcionário') }}
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-4">
                    <label for="id" class="form-label">Código</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $funcionario->id }}"
                        disabled>
                </div>
                <div class="col-8">
                    <label for="matricula" class="form-label">Matrícula</label>
                    <input type="text" class="form-control" id="matricula" name="matricula"
                        value="{{ $funcionario->matricula }}" disabled>
                </div>
            </div>
            <div class="mb-4">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $funcionario->nome }}"
                    disabled>
            </div>
            <a href="{{ route('admin.funcionarios.edit', $funcionario) }}" class="btn btn-secondary">Editar Funcionário</a>
        </div>
    </div>
@endsection
