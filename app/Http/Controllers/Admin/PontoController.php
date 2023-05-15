<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PontoRequest;
use App\Models\Ponto;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PontoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.ponto.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $responsaveis = User::where('is_admin', false)
            ->orderBy('name')
            ->get();

        return view('admin.ponto.create', compact('responsaveis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PontoRequest $request): RedirectResponse
    {
        $ponto = Ponto::create($request->validated());

        return redirect()->route('admin.pontos.edit', $ponto)
            ->with('success', 'Ponto criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ponto $ponto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ponto $ponto): View
    {
        return view('admin.ponto.edit', compact('ponto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PontoRequest $request, Ponto $ponto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ponto $ponto): RedirectResponse
    {
        $ponto->delete();

        return redirect()->route('admin.pontos.index')->with('success', 'Ponto excluído com sucesso.');
    }
}
