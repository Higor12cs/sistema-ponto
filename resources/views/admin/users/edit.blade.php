@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Editar Usuário</h4>
        <div class="d-flex">
            <form action="{{ route('admin.users.switch-active-status', $user) }}" method="POST">
                @csrf
                @if (!$user->active)
                    <button type="submit" class="btn btn-primary me-1">Ativar Usuário</button>
                @else
                    <button type="submit" class="btn btn-danger me-1">Desativar Usuário</button>
                @endif
            </form>
            <form action="{{ route('admin.users.set-to-reset-password', $user) }}" method="POST">
                @csrf
                <button
                    onclick="return confirm('Tem certeza que deseja prosseguir com esta ação? No próximo login, o usuário deverá redefinir sua senha. A senha padrão é o seu nome de usuário.')"
                    type="submit" class="btn btn-danger me-1">Redefinir Senha</button>
            </form>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Editar Usuário') }}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif"
                        id="name" name="name" value="{{ old('name', $user->name ?? '') }}">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="username" class="form-label">Usuário</label>
                    <input type="text" class="form-control @if ($errors->has('username')) is-invalid @endif"
                        id="username" name="username" value="{{ old('username', $user->username ?? '') }}">
                    @if ($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary me-1">Salvar</button>
            </form>
        </div>
    </div>
@endsection
