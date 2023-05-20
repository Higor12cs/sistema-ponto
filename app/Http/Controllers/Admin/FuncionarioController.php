<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FuncionarioRequest;
use App\Models\Funcionario;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.funcionarios.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.funcionarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FuncionarioRequest $request): RedirectResponse
    {
        Funcionario::create($request->validated());

        return redirect()->route('admin.funcionarios.index')
            ->with('success', 'Funcionário cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Funcionario $funcionario): View
    {
        return view('admin.funcionarios.show', compact('funcionario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Funcionario $funcionario): View
    {
        return view('admin.funcionarios.edit', compact('funcionario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FuncionarioRequest $request, Funcionario $funcionario): RedirectResponse
    {
        $funcionario->update($request->validated());

        return redirect()->route('admin.funcionarios.index')->with('success', 'Funcionário atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcionario $funcionario): RedirectResponse
    {
        $funcionario->delete();

        return redirect()->route('admin.funcionarios.index')
            ->with('succcess', 'Funcionário excluído com sucesso.');
    }
}
