@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Usuário</h4>
        <div class="d-flex">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Usuário') }}
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                    disabled>
            </div>
            <div class="mb-4">
                <label for="name" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->username }}"
                    disabled>
            </div>

            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-secondary">Editar Usuário</a>
        </div>
    </div>
@endsection
