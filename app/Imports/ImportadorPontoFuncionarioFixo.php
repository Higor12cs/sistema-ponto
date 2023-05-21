<?php

namespace App\Imports;

use App\Models\Funcionario;
use App\Models\Ponto;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
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
        Validator::make($rows->toArray(), [
            '*.0' => 'required',
            '*.1' => 'required',
            '*.2' => 'required',
        ], [
            '*.0.required' => 'O valor da célula :attribute é obrigatório. Todas matrículas são obrigatórias',
            '*.1.required' => 'O valor da célula :attribute é obrigatório. Todos nomes são obrigatórios',
            '*.2.required' => 'O valor da célula :attribute é obrigatório. Todas datas são obrigatórias.',
        ])->validate();

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
