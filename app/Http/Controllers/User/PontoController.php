<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ponto;
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
}
