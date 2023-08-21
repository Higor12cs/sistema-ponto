@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <h4>{{ __('Importador') }}</h4>
        <div class="d-flex">
        </div>
    </div>

    @if (session('success'))
        <div id="bootstrap-alert" class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @elseif (session('warning'))
        <div id="bootstrap-warning-alert" class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endforeach
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">Importadores</div>
        <div class="card-body">
            <p class="fw-bold">Considerações importantes:</p>
            <div class="alert alert-primary pb-0">
                <p><span class="fw-bold">Todos importadores</span> esperam arquivos .xls ou .xlsx. Qualquer outro tipo de
                    arquivo
                    será automaticamente <span class="fw-bold">recusado</span> pela regra de validação.</p>
            </div>
            <div class="alert alert-primary pb-0">
                <p><span class="fw-bold">Todos importadores</span> esperam a primeira linha como cabeçalho. <span class="fw-bold">Somente a primeira
                        linha.</span></p>
            </div>
            <div class="alert alert-primary pb-0">
                <p>Em casos de celulas vazias, <span class="fw-bold">a importação irá falhar e todas alterações serão
                        revertidas.</span></p>
            </div>

            <hr>

            <div class="d-flex justify-content-between">
                <h5>Método 1 - Importação com intervalo de datas</h5>
                <button class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#dateRangeImportModal">Importar Layout</button>
            </div>

            <p>Neste método, o programa espera o seguinte layout dentro do aqruivo:</p>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>Matrícula</th>
                        <th>Nome</th>
                        <th>Responsável</th>
                        <th>Hora Entrada</th>
                        <th>Hora Saída</th>
                    </thead>
                    <tbody>
                        <tr class="table-active">
                            <td>ABC1234</td>
                            <td>João</td>
                            <td>1</td>
                            <td>07:00</td>
                            <td>18:00</td>
                        </tr>
                        <tr class="table-active">
                            <td>DEF567</td>
                            <td>José</td>
                            <td>1</td>
                            <td>07:00</td>
                            <td>18:00</td>
                        </tr>
                        <tr>
                            <td>GHI890</td>
                            <td>Rafael</td>
                            <td>2</td>
                            <td>07:00</td>
                            <td>18:00</td>
                        </tr>
                        <tr>
                            <td>JKL123</td>
                            <td>Carlos</td>
                            <td>2</td>
                            <td>07:00</td>
                            <td>18:00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p>Fornecendo os dados neste layout, o script automaticamente irá agrupar os responsáveis e criar as capas dos
                pontos em todas as datas entre o período informado.</p>

        </div>
    </div>

    {{-- dateRangeImportModal --}}
    <div class="modal fade" id="dateRangeImportModal" tabindex="-1" aria-labelledby="dateRangeImportModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.import.date-range') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Importador (Intervalo de Datas)</h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="data" class="form-label">Data 1</label>
                                <input type="date" class="form-control" id="date1" name="date1">
                            </div>

                            <div class="col-6">
                                <label for="data" class="form-label">Data 2</label>
                                <input type="date" class="form-control" id="date2" name="date2">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">Arquivo</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Importar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
