@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>{{ __('Cadastrar Usuário') }}</h4>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">{{ __('Voltar') }}</a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Cadastrar Usuário') }}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Nome') }}</label>
                    <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif"
                        id="name" name="name" placeholder="{{ __('João Silva') }}">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">{{ __('Usuário') }}</label>
                    <input type="text" class="form-control @if ($errors->has('username')) is-invalid @endif"
                        id="username" name="username" placeholder="{{ __('joao-silva') }}">
                    @if ($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="is_admin" class="form-label">{{ __('Tipo Usuário') }}</label>
                    <select wire:model="is_admin" class="form-select @if ($errors->has('is_admin')) is-invalid @endif"
                        id="is_admin" name="is_admin">
                        <option value="">{{ __('-- selecione --') }}</option>
                        <option value="1">{{ __('Administrador') }}</option>
                        <option value="0">{{ __('Responsável') }}</option>
                    </select>
                    @if ($errors->has('is_admin'))
                        <div class="invalid-feedback">
                            {{ $errors->first('is_admin') }}
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
            </form>
        </div>
    </div>
@endsection
