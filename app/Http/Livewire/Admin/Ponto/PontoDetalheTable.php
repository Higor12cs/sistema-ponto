<?php

namespace App\Http\Livewire\Admin\Ponto;

use App\Http\Traits\SwalAlertsTrait;
use App\Models\Ponto;
use Livewire\Component;

class PontoDetalheTable extends Component
{
    use SwalAlertsTrait;

    protected $listeners = [
        'funcionarioAdicionado' => 'render',
        'funcionarioRemovido' => 'render',
    ];

    public $ponto;
    public $funcionarios;

    public function mount(Ponto $ponto)
    {
        $this->ponto = $ponto;
    }

    public function render()
    {
        $this->funcionarios = $this->ponto->funcionarios;

        return view('livewire.admin.ponto.ponto-detalhe-table');
    }

    public function removerFuncionario($funcionario)
    {
        $this->ponto->funcionarios()->detach($funcionario['id']);
        $this->emit('funcionarioRemovido');

        $this->emitAlert('success', 'Funcionário removido!');
    }
}
