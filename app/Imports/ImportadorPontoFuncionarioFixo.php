<?php

namespace App\Imports;

use App\Models\Funcionario;
use App\Models\Ponto;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportadorPontoFuncionarioFixo implements ToCollection
{
    private $responsavel;
    private $firstRow = true;

    public function __construct($responsavel)
    {
        $this->responsavel = $responsavel;
    }

    public function collection(Collection $rows)
    {
        $groupedRows = $rows->groupBy(2);

        $groupedRows->each(function ($rows, $data) {
            if ($this->firstRow) {
                $this->firstRow = false;
            } else {
                $ponto = new Ponto();
                $ponto->data = Carbon::instance(Date::excelToDateTimeObject($data));
                $ponto->user_id = $this->responsavel;
                $ponto->save();

                foreach ($rows as $row) {
                    $funcionario = Funcionario::firstOrNew(['matricula' => $row[0]]);

                    if (!$funcionario->exists) {
                        $funcionario->nome = $row[1];
                        $funcionario->save();
                    }

                    $ponto->funcionarios()->attach($funcionario->id);
                }
            }
        });
    }
}
