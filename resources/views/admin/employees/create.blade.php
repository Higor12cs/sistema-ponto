@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>{{ __('Cadastrar Funcionário') }}</h4>
        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-secondary">{{ __('Voltar') }}</a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Cadastrar Funcionário') }}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.employees.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="registration" class="form-label">{{ __('Matrícula') }}</label>
                    <input type="text" class="form-control @if ($errors->has('registration')) is-invalid @endif"
                        id="registration" name="registration" placeholder="ABC123" value="{{ @old('registration') }}">
                    @if ($errors->has('registration'))
                        <div class="invalid-feedback">
                            {{ $errors->first('registration') }}
                        </div>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="name" class="form-label">{{ __('Nome') }}</label>
                    <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif"
                        id="name" name="name" placeholder="João da Silva" value="{{ @old('name') }}">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
            </form>
        </div>
    </div>
@endsection
