@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-betwewen mb-4">
        <h4>{{ __('Dashboard') }}</h4>
    </div>

    <x-alerts />

    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $openAttendancesCount }}</div>
                        <div class="text-nowrap">Pontos Abertos</div>
                    </div>
                </div>
                <br>
                <br>
                <br>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $closedAttendancesCount }}</div>
                        <div class="text-nowrap">Pontos Fechados</div>
                    </div>
                </div>
                <br>
                <br>
                <br>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-dark">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $usersCount }}</div>
                        <div class="text-nowrap">Responsáveis Cadastrados</div>
                    </div>
                </div>
                <br>
                <br>
                <br>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-dark">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $employessCount }}</div>
                        <div class="text-nowrap">Funcionários Cadastrados</div>
                    </div>
                </div>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
@endsection
