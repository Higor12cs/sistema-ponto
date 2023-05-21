<?php

namespace App\Imports;

use App\Models\Funcionario;
use App\Models\Ponto;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportadorPontoDataFixa implements ToCollection
{
    private $data;
    private $firstRow = true;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection(Collection $rows)
    {
        $groupedRows = $rows->groupBy(2);

        $groupedRows->each(function ($rows, $responsavel) {
            if ($this->firstRow) {
                $this->firstRow = false;
            } else {
                $ponto = new Ponto();
                $ponto->data = $this->data;
                $ponto->user_id = $responsavel;
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
