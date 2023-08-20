<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConfigurationController extends Controller
{
    public function index(): View
    {
        $userAttendanceDisplayLimit = Configuration::where('key', 'USER_ATTENDANCE_DISPLAY_LIMIT')->first();

        return view('admin.configurations.index', compact('userAttendanceDisplayLimit'));
    }

    public function setUserAttendanceDisplayLimit(Request $request): RedirectResponse
    {
        $request->validate([
            'number-of-days' => 'required|numeric',
        ]);

        Configuration::where('key', 'USER_ATTENDANCE_DISPLAY_LIMIT')
            ->update(['value' => $request->input('number-of-days')]);

        return to_route('admin.configuration.index')->with('success', __('Configurações atualizadas com sucesso!'));
    }
}
