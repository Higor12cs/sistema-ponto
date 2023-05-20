@extends('layouts.guest')

@section('content')
    <div class="col-10 col-lg-6">
        <div class="card-group d-block d-md-flex row">
            <div class="card col-md-7 p-3 mb-0">
                <div class="card-body">
                    <h3 class="mb-4">{{ __('Definir Nova Senha') }}</h3>
                    <form action="{{ route('new-password.update') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3"><span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                                </svg></span>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                name="password" placeholder="{{ __('Senha') }}" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-4"><span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                                </svg></span>
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                                name="password_confirmation" placeholder="{{ __('Confirme sua Senha') }}" required
                                autocomplete="new-password">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary px-4" type="submit">{{ __('Alterar') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
