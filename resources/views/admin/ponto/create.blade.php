@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>{{ __('Criar Ponto') }}</h4>
        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-secondary">Voltar</a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Criar Ponto') }}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pontos.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="data" class="form-label">Data</label>
                    <input type="date" class="form-control @if ($errors->has('data')) is-invalid @endif"
                        id="data" name="data">
                    @if ($errors->has('data'))
                        <div class="invalid-feedback">
                            {{ $errors->first('data') }}
                        </div>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="user_id" class="form-label">Responsável</label>
                    <select class="form-select @if ($errors->has('user_id')) is-invalid @endif"
                        aria-label="Seleção de Responsável" id="user_id" name="user_id">
                        <option value="">-- selecione --</option>
                        @foreach ($responsaveis as $responsavel)
                            <option value="{{ $responsavel->id }}">{{ $responsavel->name . ' - ' . $responsavel->id }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('user_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('user_id') }}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
