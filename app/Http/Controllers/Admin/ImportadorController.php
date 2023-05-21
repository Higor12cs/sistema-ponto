<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportarDataFixaRequest;
use App\Http\Requests\ImportarFuncionarioFixoRequest;
use App\Imports\ImportadorPontoDataFixa;
use App\Imports\ImportadorPontoFuncionarioFixo;
use App\Models\User;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ImportadorController extends Controller
{
    public function index(): View
    {
        $responsaveis = User::where('is_admin', false)->get();

        return view('admin.importador.index', compact('responsaveis'));
    }

    public function importarDataFixa(ImportarDataFixaRequest $request)
    {
        $file = $request->file('file');
        $data = $request->data;

        Excel::import(new ImportadorPontoDataFixa($data), $file);

        return redirect()->back()->with('success', 'Pontos importados com sucesso.');
    }

    public function importarFuncionarioFixo(ImportarFuncionarioFixoRequest $request)
    {
        $file = $request->file('file');
        $responsavel = $request->responsavel;

        Excel::import(new ImportadorPontoFuncionarioFixo($responsavel), $file);

        return redirect()->back()->with('success', 'Pontos importados com sucesso.');
    }
}
