@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>Cadastrar Usuário</h4>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Cadastrar Usuário') }}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif"
                        id="name" name="name" placeholder="João Silva">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Usuário</label>
                    <input type="text" class="form-control @if ($errors->has('username')) is-invalid @endif"
                        id="username" name="username" placeholder="joao-silva">
                    @if ($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="is_admin" class="form-label">Tipo Usuário</label>
                    <select wire:model="is_admin" class="form-select @if ($errors->has('is_admin')) is-invalid @endif"
                        id="is_admin" name="is_admin">
                        <option value="">-- selecione --</option>
                        <option value="1">Administrador</option>
                        <option value="0">Responsável</option>
                    </select>
                    @if ($errors->has('is_admin'))
                        <div class="invalid-feedback">
                            {{ $errors->first('is_admin') }}
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
