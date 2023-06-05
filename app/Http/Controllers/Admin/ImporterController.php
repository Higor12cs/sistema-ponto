<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateRangeImportRequest;
use App\Http\Requests\FixedDateImportRequest;
use App\Http\Requests\FixedEmployeeImportRequest;
use App\Imports\DateRangeAttendanceImport;
use App\Imports\FixedDateAttendanceImport;
use App\Imports\FixedManagerAttendanceImport;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ImporterController extends Controller
{
    public function index(): View
    {
        $managers = User::where('is_admin', false)->get();

        return view('admin.importer.index', compact('managers'));
    }

    public function fixedDateImport(FixedDateImportRequest $request): RedirectResponse
    {
        Excel::import(new FixedDateAttendanceImport($request->date), $request->file('file'));

        return redirect()->back()->with('success', 'Pontos importados com sucesso.');
    }

    public function dateRangeImport(DateRangeImportRequest $request): RedirectResponse
    {
        Excel::import(new DateRangeAttendanceImport($request->date1, $request->date2), $request->file('file'));

        return redirect()->back()->with('success', 'Pontos importados com sucesso.');
    }

    public function fixedManagerImport(FixedEmployeeImportRequest $request): RedirectResponse
    {
        Excel::import(new FixedManagerAttendanceImport($request->manager), $request->file('file'));

        return redirect()->back()->with('success', 'Pontos importados com sucesso.');
    }
}
