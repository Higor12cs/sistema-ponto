<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use App\Models\Ponto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RelatorioController extends Controller
{
    public function filtroPorResponsavel(): View
    {
        $users = User::where('is_admin', false)->get();

        return view('admin.relatorios.responsavel', compact('users'));
    }

    public function filtroPorFuncionario(): View
    {
        $funcionarios = Funcionario::all();

        return view('admin.relatorios.funcionario', compact('funcionarios'));
    }

    public function relatorioPorResponsavel(Request $request)
    {
        $user_id = $request->user_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $report = true;
        $users = User::where('is_admin', false)->get();

        $pontos = Ponto::where('user_id', $user_id)
            ->whereBetween('data', [$start_date, $end_date])
            ->whereHas('funcionarios', function ($query) use ($user_id) {
                $query->where('funcionarios.id', $user_id)
                    ->with(['pivot' => ['entrada1', 'saida1']]);
            })
            ->with(['funcionarios', 'user'])
            ->get();

        return view('admin.relatorios.responsavel', compact('report', 'users', 'pontos', 'start_date', 'end_date', 'user_id'));
    }
}
