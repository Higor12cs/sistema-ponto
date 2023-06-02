@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Editar Usuário</h4>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Voltar</a>
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
