<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RelatorioController extends Controller
{
    public function index(): View
    {
        return view('admin.relatorios.index');
    }
}