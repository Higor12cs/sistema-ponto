@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>{{ __('Editar Funcionário') }}</h4>
        <div class="d-flex">
            <a href="{{ route('admin.employees.show', $employee) }}" class="btn btn-secondary">{{ __('Voltar') }}</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Editar Funcionário') }}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.employees.update', $employee->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="id" class="form-label">{{ __('Código') }}</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{ $employee->id }}"
                            disabled>
                    </div>
                    <div class="col-8">
                        <label for="registration" class="form-label">{{ __('Matrícula') }}</label>
                        <input type="text" class="form-control @if ($errors->has('registration')) is-invalid @endif"
                            id="registration" name="registration" placeholder="{{ __('ABC123') }}"
                            value="{{ old('registration', $employee->registration ?? '') }}">
                        @if ($errors->has('registration'))
                            <div class="invalid-feedback">
                                {{ $errors->first('registration') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mb-4">
                    <label for="name" class="form-label">{{ __('Nome') }}</label>
                    <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif"
                        id="name" name="name" placeholder="{{ __('João da Silva') }}"
                        value="{{ old('name', $employee->name ?? '') }}">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
            </form>
        </div>
    </div>
@endsection
