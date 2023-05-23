<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ponto;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PontoController extends Controller
{
    public function index(): View
    {
        return view('user.ponto.index');
    }

    public function preencher(Ponto $ponto): View
    {
        return view('user.ponto.preencher', compact('ponto'));
    }

    public function close(Ponto $ponto): RedirectResponse
    {
        $everyEmployeeHasHours = $ponto->funcionarios->every(function ($funcionario) {
            return !empty($funcionario->pivot->entrada1) && !empty($funcionario->pivot->saida1);
        });

        if (!$everyEmployeeHasHours) {
            return redirect()->route('pontos.preencher', $ponto)
                ->with('warning', 'Ainda existem funcionários sem horarios definidos neste ponto.');
        }

        $ponto->update([
            'finalizado' => true,
            'finalizado_em' => now(),
        ]);

        return redirect()->route('pontos.index')
            ->with('success', 'Ponto concluído e fechado com sucesso.');
    }
}
