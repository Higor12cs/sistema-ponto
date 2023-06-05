@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>{{ __('Visualizar Funcionário') }}</h4>
        <div class="d-flex">
            <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST">
                @csrf
                @method('DELETE')
                @if ($employee->active)
                    <button onclick="return confirm('Tem certeza que deseja excluir este funcionário?')" type="submit"
                        class="btn btn-danger me-1">{{ __('Desativar') }}</button>
                @else
                    <button type="submit" class="btn btn-primary me-1">{{ __('Ativar') }}</button>
                @endif
            </form>
            <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">{{ __('Voltar') }}</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Visualizar Funcionário') }}
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-4">
                    <label for="id" class="form-label">{{ __('Código') }}</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $employee->id }}"
                        disabled>
                </div>
                <div class="col-8">
                    <label for="registration" class="form-label">{{ __('Matrícula') }}</label>
                    <input type="text" class="form-control" id="registration" name="registration"
                        value="{{ $employee->registration }}" disabled>
                </div>
            </div>
            <div class="mb-4">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}"
                    disabled>
            </div>
            <a href="{{ route('admin.employees.edit', $employee) }}"
                class="btn btn-secondary">{{ __('Editar Funcionário') }}</a>
        </div>
    </div>
@endsection
