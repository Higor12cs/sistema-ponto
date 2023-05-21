@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-betewen mb-4">
        <h4>Dados do Usuário</h4>
    </div>

    <x-alerts />

    <div class="card mb-4">
        <div class="card-header">
            {{ __('Meu Perfil') }}
        </div>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="mb-2">
                    <label class="form-label">Nome</label>
                    <input class="form-control" type="text" name="name" placeholder="{{ __('Nome') }}"
                        value="{{ old('name', auth()->user()->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="form-label">Usuário</label>
                    <input class="form-control" type="text" name="username" placeholder="{{ __('Usuário') }}"
                        value="{{ old('username', auth()->user()->username) }}" required>
                    @error('username')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="form-label">Senha</label>
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                        placeholder="{{ __('Nova senha') }}" required>
                    @error('password')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirmação</label>
                    <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                        name="password_confirmation" placeholder="{{ __('Confirmação da nova senha') }}" required>
                </div>

                <button class="btn btn-primary" type="submit">{{ __('Atualizar') }}</button>
            </div>

        </form>

    </div>
@endsection
