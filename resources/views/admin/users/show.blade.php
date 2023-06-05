@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>{{ __('Usuário') }}</h4>
        <div class="d-flex">
            <form action="{{ route('admin.users.switch-active-status', $user) }}" method="POST">
                @csrf
                @if (!$user->active)
                    <button type="submit" class="btn btn-primary me-1">{{ __('Ativar Usuário') }}</button>
                @else
                    <button type="submit" class="btn btn-danger me-1">{{ __('Desativar Usuário') }}</button>
                @endif
            </form>
            <form action="{{ route('admin.users.set-to-reset-password', $user) }}" method="POST">
                @csrf
                <button
                    onclick="return confirm('{{ __('Tem certeza que deseja prosseguir com esta ação? No próximo login, o usuário deverá redefinir sua senha. A senha padrão é o seu nome de usuário.') }}')"
                    type="submit" class="btn btn-danger me-1">{{ __('Redefinir Senha') }}</button>
            </form>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">{{ __('Voltar') }}</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Usuário') }}
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Nome') }}</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                    disabled>
            </div>
            <div class="mb-4">
                <label for="name" class="form-label">{{ __('Usuário') }}</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->username }}"
                    disabled>
            </div>

            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-secondary">{{ __('Editar Usuário') }}</a>
        </div>
    </div>
@endsection
