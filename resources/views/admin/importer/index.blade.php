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
                <p><span class="fw-bold">Todos importadores</span> esperam a primeira linha como cabeçalho. <span
                        class="fw-bold">Somente a primeira
                        linha.</span></p>
            </div>
            <div class="alert alert-primary pb-0">
                <p>Em casos de celulas vazias, <span class="fw-bold">a importação irá falhar e todas alterações serão
                        revertidas.</span></p>
            </div>

            <hr>

            <div class="d-flex justify-content-between">
                <h5>Método 1 - Importação com intervalo de datas</h5>
                <button class="btn btn-primary" data-coreui-toggle="modal"
                    data-coreui-target="#dateRangeImportModal">Importar Layout</button>
            </div>

            <p>Neste método, o programa espera o seguinte layout dentro do aqruivo:</p>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>Matrícula</th>
                        <th>Nome</th>
                        <th>Responsável</th>
                    </thead>
                    <tbody>
                        <tr class="table-active">
                            <td>ABC1234</td>
                            <td>João</td>
                            <td>1</td>
                        </tr>
                        <tr class="table-active">
                            <td>DEF567</td>
                            <td>José</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>GHI890</td>
                            <td>Rafael</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>JKL123</td>
                            <td>Carlos</td>
                            <td>2</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p>Fornecendo os dados neste layout, o script automaticamente irá agrupar os responsáveis e criar as capas dos
                pontos em todas as datas entre o período informado.</p>

            <hr>

            <div class="d-flex justify-content-between">
                <h5>Método 2 - Importação com data manual fixa</h5>
                <button class="btn btn-primary" data-coreui-toggle="modal"
                    data-coreui-target="#fixedDateImportModal">Importar Layout</button>
            </div>

            <p>Neste método, o programa espera o seguinte layout dentro do aqruivo:</p>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>Matrícula</th>
                        <th>Nome</th>
                        <th>Responsável</th>
                    </thead>
                    <tbody>
                        <tr class="table-active">
                            <td>ABC1234</td>
                            <td>João</td>
                            <td>1</td>
                        </tr>
                        <tr class="table-active">
                            <td>DEF567</td>
                            <td>José</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>GHI890</td>
                            <td>Rafael</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>JKL123</td>
                            <td>Carlos</td>
                            <td>2</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p>Fornecendo os dados neste layout, o script automaticamente irá agrupar os responsáveis e criar as capas dos
                pontos com a data informada manualmente no ato da importação.</p>
            <p>Por exemplo, no cado de uma planilha importada com 50 funcionários (50 linhas), contendo 5 responsávies,
                serão geradas 10 capas. E relacionadas a cada capa existirá 10 funcionários.</p>

            <hr>

            <div class="d-flex justify-content-between">
                <h5>Método 3 - Importação de responsável individual fixo</h5>
                <button type="button" class="btn btn-primary" data-coreui-toggle="modal"
                    data-coreui-target="#fixedManagerImportModal">Importar Layout</button>
            </div>

            <p>Neste método, o programa espera o seguint layout dentro do aqruivo:</p>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>Matrícula</th>
                        <th>Nome</th>
                        <th>Data</th>
                    </thead>
                    <tbody>
                        <tr class="table-active">
                            <td>ABC1234</td>
                            <td>João</td>
                            <td>01/01/2023</td>
                        </tr>
                        <tr class="table-active">
                            <td>DEF567</td>
                            <td>José</td>
                            <td>01/01/2023</td>
                        </tr>

                        <tr>
                            <td>ABC1234</td>
                            <td>João</td>
                            <td>02/01/2023</td>
                        </tr>
                        <tr>
                            <td>DEF567</td>
                            <td>José</td>
                            <td>02/01/2023</td>
                        </tr>

                        <tr class="table-active">
                            <td>ABC1234</td>
                            <td>João</td>
                            <td>03/01/2023</td>
                        </tr>
                        <tr class="table-active">
                            <td>DEF567</td>
                            <td>José</td>
                            <td>03/01/2023</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p>Já neste layout, o usuário primaryrmará o responsável em que os pontos serão criados. Assim, o script
                automaticamente irá gerar diversos pontos em diversas datas com os respectivos funcionários. Mas todos serão
                atríbuídos ao mesmo responsável.</p>
            <p>Neste exemplo, seriam criados 3 pontos para o responsável primaryrmado no ato da importação, um na data de
                01/01/2023, outro em 02/01/2023 e o último com data de 03/01/2023. Todos com dois responsáveis em cada
                ponto.</p>

            <hr>

            {{-- <div class="d-flex justify-content-between">
                <h5>Método 4 - Importação automática [Em desenvolvimento]</h5>
                <button class="btn btn-primary" disabled>Importar Layout</button>
            </div>

            <p>Neste método, o programa espera o seguinte layout dentro do aqruivo:</p>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <th>Matrícula</th>
                        <th>Nome</th>
                        <th>Responsável</th>
                        <th>Data</th>
                    </thead>
                    <tbody>
                        <tr class="table-active">
                            <td>ABC1234</td>
                            <td>João</td>
                            <td>1</td>
                            <td>01/01/2023</td>
                        </tr>
                        <tr class="table-active">
                            <td>DEF567</td>
                            <td>José</td>
                            <td>1</td>
                            <td>01/01/2023</td>
                        </tr>
                        <tr>
                            <td>GHI890</td>
                            <td>Rafael</td>
                            <td>2</td>
                            <td>01/01/2023</td>
                        </tr>
                        <tr>
                            <td>JKL123</td>
                            <td>Carlos</td>
                            <td>2</td>
                            <td>01/01/2023</td>
                        </tr>

                        <tr class="table-active">
                            <td>ABC1234</td>
                            <td>João</td>
                            <td>1</td>
                            <td>02/01/2023</td>
                        </tr>
                        <tr class="table-active">
                            <td>DEF567</td>
                            <td>José</td>
                            <td>1</td>
                            <td>02/01/2023</td>
                        </tr>
                        <tr>
                            <td>GHI890</td>
                            <td>Rafael</td>
                            <td>2</td>
                            <td>02/01/2023</td>
                        </tr>
                        <tr>
                            <td>JKL123</td>
                            <td>Carlos</td>
                            <td>2</td>
                            <td>02/01/2023</td>
                        </tr>

                        <tr class="table-active">
                            <td>ABC1234</td>
                            <td>João</td>
                            <td>1</td>
                            <td>03/01/2023</td>
                        </tr>
                        <tr class="table-active">
                            <td>DEF567</td>
                            <td>José</td>
                            <td>1</td>
                            <td>03/01/2023</td>
                        </tr>
                        <tr>
                            <td>GHI890</td>
                            <td>Rafael</td>
                            <td>2</td>
                            <td>03/01/2023</td>
                        </tr>
                        <tr>
                            <td>JKL123</td>
                            <td>Carlos</td>
                            <td>2</td>
                            <td>03/01/2023</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p>Aqui o script automaticamente identifica todas as primaryrmações e cria os pontos, sem a necessidade de
                nenhuma
                primaryrmação manual por parte do usuário.</p>
            <p>No exemplo acima, o script identificaria 6 pontos. O responsável 1 receberia pontos em 01/01/2023, 02/01/2023
                e 03/01/2023, com dois funcionários em cada, assim como o responsável 2.</p> --}}

        </div>
    </div>

    {{-- fixedDateImportModal --}}
    <div class="modal fade" id="fixedDateImportModal" tabindex="-1" aria-labelledby="modalfixedDateImportModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.import.fixed-date') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalfixedDateImportModal">Importador (Data Fixa)</h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="data" class="form-label">Data</label>
                            <input type="date" class="form-control" id="date" name="date">
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

    {{-- dateRangeImportModal --}}
    <div class="modal fade" id="dateRangeImportModal" tabindex="-1" aria-labelledby="dateRangeImportModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.import.date-range') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Importador (Intervalo de Datas)</h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal"
                            aria-label="Close"></button>
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

    {{-- fixedManagerImportModal --}}
    <div class="modal fade" id="fixedManagerImportModal" tabindex="-1"
        aria-labelledby="modalImportacaoResponsavelFixoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.import.fixed-manager') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Importador (Responsável Fixo)</h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="manager" class="form-label">Responsável</label>
                            <select class="form-select" id="manager" name="manager">
                                <option value="">-- selecione --</option>
                                @foreach ($managers as $manager)
                                    <option value="{{ $manager->id }}">
                                        {{ $manager->name . ' - ' . $manager->id }}
                                    </option>
                                @endforeach
                            </select>
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
