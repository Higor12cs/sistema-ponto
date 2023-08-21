<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(): View
    {
        return view('admin.employees.index');
    }

    public function create(): View
    {
        return view('admin.employees.create');
    }

    public function store(EmployeeRequest $request): RedirectResponse
    {
        Employee::create($request->validated());

        return to_route('admin.employees.index')
            ->with('success', 'Funcionário cadastrado com sucesso.');
    }

    public function show(Employee $employee): View
    {
        return view('admin.employees.show', compact('employee'));
    }

    public function edit(Employee $employee): View
    {
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(EmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $employee->update($request->validated());

        return to_route('admin.employees.index')
            ->with('success', 'Funcionário atualizado com sucesso.');
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        // $employee->delete();
        $employee->update(['active' => ! $employee->active]);

        return to_route('admin.employees.index')
            ->with('success', 'Funcionário atualizado com sucesso.');
    }
}
