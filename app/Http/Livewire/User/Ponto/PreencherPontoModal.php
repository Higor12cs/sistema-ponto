<?php

namespace App\Http\Livewire\User\Ponto;

use App\Http\Traits\SwalAlertsTrait;
use App\Models\Funcionario;
use App\Models\Ponto;
use Livewire\Component;

class PreencherPontoModal extends Component
{
    use SwalAlertsTrait;

    public $apontamento;
    public $entrada1, $saida1;

    protected $listeners = [
        'apontarFuncionario' => 'apontar',
    ];

    public $funcionario;

    public function render()
    {
        return view('livewire.user.ponto.preencher-ponto-modal');
    }

    public function apontar($apontamento)
    {
        $this->apontamento = $apontamento;
        $this->entrada1 = $apontamento['pivot']['entrada1'];
        $this->saida1 = $apontamento['pivot']['saida1'];

        $this->dispatchBrowserEvent('modal', [
            'name' => 'apontamentoModal',
            'action' => 'show',
        ]);
    }

    public function salvar()
    {
        $this->validate([
            'entrada1' => 'required',
            'saida1' => 'required',
        ]);

        $ponto = Ponto::findOrFail($this->apontamento['pivot']['ponto_id']);

        $ponto->funcionarios()
            ->updateExistingPivot($this->apontamento['pivot']['funcionario_id'], [
                'entrada1' => $this->entrada1,
                'saida1' => $this->saida1,
            ]);

        $this->emit('funcionarioApontado');
        $this->emitAlert('success', 'Funcionário apontado!');

        $this->dispatchBrowserEvent('modal', [
            'name' => 'apontamentoModal',
            'action' => 'hide',
        ]);

        $this->reset();
    }
}
