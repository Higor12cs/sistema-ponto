@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Cadastrar Funcionário</h4>
        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-secondary">Voltar</a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Cadastrar Funcionário') }}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.funcionarios.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="matricula" class="form-label">Matrícula</label>
                    <input type="text" class="form-control @if ($errors->has('matricula')) is-invalid @endif"
                        id="matricula" name="matricula" placeholder="ABC123">
                    @if ($errors->has('matricula'))
                        <div class="invalid-feedback">
                            {{ $errors->first('matricula') }}
                        </div>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control @if ($errors->has('nome')) is-invalid @endif"
                        id="nome" name="nome" placeholder="João da Silva">
                    @if ($errors->has('nome'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nome') }}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
