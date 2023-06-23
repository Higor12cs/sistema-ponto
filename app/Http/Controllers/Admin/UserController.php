<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SetNewPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index');
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['username']),
            'is_admin' => $validatedData['is_admin'],
        ]);

        return to_route('admin.users.index')->with('success', 'Usuário cadastrado com sucesso.');
    }

    public function show(User $user): View
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        return to_route('admin.users.index')
            ->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy(User $user): RedirectResponse
    {
        // $user->delete();

        // return to_route('admin.users.index')
        //     ->with('succcess', 'Usuário excluído com sucesso.');

        abort(403);
    }

    public function newPassword(): RedirectResponse|View
    {
        $user = auth()->user();

        if ($user->password_on_login) {
            return view('auth.new-password');
        }

        return auth()->user()->is_admin ?
            to_route('admin.dashboard') : to_route('dashboard');
    }

    public function setNewPassword(SetNewPasswordRequest $request): RedirectResponse
    {
        auth()->user()->update([
            'password_on_login' => false,
            'password' => bcrypt($request->password),
        ]);

        return auth()->user()->is_admin ?
            to_route('admin.dashboard')->with('success', 'Senha atualizada com sucesso.') : to_route('dashboard')->with('success', 'Senha atualizada com sucesso.');
    }

    public function setToResetPassword(User $user): RedirectResponse
    {
        $user->password_on_login = true;
        $user->password = bcrypt($user->username);
        $user->save();

        if ($user->id == auth()->user()->id) {
            auth()->logout();
            return to_route('login');
        }

        return to_route('admin.users.index')
            ->with('success', 'Usuário definido para restaurar sua senha no próximo login.');
    }

    public function switchUserActiveStatus(User $user): RedirectResponse
    {
        if ($user->id == auth()->id()) {
            return to_route('admin.users.index')
                ->with('danger', 'Um usuário não pode se desativar. Por favor, entre como outro usuário administrador para desativar esta conta.');
        }

        $user->active = !$user->active;
        $user->save();

        return to_route('admin.users.index')->with('success', 'Status alterado com sucesso.');
    }
}
