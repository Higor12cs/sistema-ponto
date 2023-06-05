<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FixedDateImportRequest;
use App\Http\Requests\FixedEmployeeImportRequest;
use App\Imports\FixedDateAttendanceImport;
use App\Imports\FixedManagerAttendanceImport;
use App\Models\User;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ImporterController extends Controller
{
    public function index(): View
    {
        $managers = User::where('is_admin', false)->get();

        return view('admin.importer.index', compact('managers'));
    }

    public function fixedDateImport(FixedDateImportRequest $request)
    {
        $file = $request->file('file');
        $date = $request->date;

        Excel::import(new FixedDateAttendanceImport($date), $file);

        return redirect()->back()->with('success', 'Pontos importados com sucesso.');
    }

    public function fixedManagerImport(FixedEmployeeImportRequest $request)
    {
        $file = $request->file('file');
        $manager = $request->manager;

        Excel::import(new FixedManagerAttendanceImport($manager), $file);

        return redirect()->back()->with('success', 'Pontos importados com sucesso.');
    }
}
