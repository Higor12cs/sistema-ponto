@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>{{ __('Criar Ponto') }}</h4>
        <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-secondary">{{ __('Voltar') }}</a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Criar Ponto') }}
        </div>
        <div class="card-body">
            <form action="{{ route('admin.attendances.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="data" class="form-label">{{ __('Data') }}</label>
                    <input type="date" class="form-control @if ($errors->has('date')) is-invalid @endif"
                        id="date" name="date" value="{{ @old('date') }}">
                    @if ($errors->has('data'))
                        <div class="invalid-feedback">
                            {{ $errors->first('date') }}
                        </div>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="user_id" class="form-label">{{ __('Responsável') }}</label>
                    <select class="form-select @if ($errors->has('user_id')) is-invalid @endif" id="user_id" name="user_id">
                        <option value="">{{ __('-- selecione --') }}</option>
                        @foreach ($managers as $manager)
                            <option value="{{ $manager->id }}">{{ $manager->name . ' - ' . $manager->id }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('user_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('user_id') }}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
            </form>
        </div>
    </div>
@endsection
