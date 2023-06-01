<?php

namespace App\Http\Livewire\User\Ponto;

use App\Http\Traits\HasModalTrait;
use App\Http\Traits\SwalAlertsTrait;
use App\Models\Ponto;
use Livewire\Component;

class PreencherPontoModal extends Component
{
    use SwalAlertsTrait, HasModalTrait;

    public $apontamento;
    public $entrada1, $saida1, $missed;

    protected $listeners = [
        'apontarFuncionario' => 'apontar',
    ];

    public function render()
    {
        return view('livewire.user.ponto.preencher-ponto-modal');
    }

    public function apontar($apontamento)
    {
        $this->apontamento = $apontamento;
        $this->entrada1 = $apontamento['pivot']['entrada1'];
        $this->saida1 = $apontamento['pivot']['saida1'];
        $this->missed = $apontamento['pivot']['missed'];

        $this->openModal('apontamentoModal');
    }

    public function salvar()
    {
        $this->validate([
            'entrada1' => ['nullable'],
            'saida1' => ['nullable'],
            'missed' => ['sometimes', 'boolean'],
        ]);

        $ponto = Ponto::findOrFail($this->apontamento['pivot']['ponto_id']);

        $ponto->funcionarios()
            ->updateExistingPivot($this->apontamento['pivot']['funcionario_id'], [
                'entrada1' => $this->missed ? null : $this->entrada1,
                'saida1' => $this->missed ? null : $this->saida1,
                'missed' => $this->missed,
            ]);

        $this->emit('funcionarioApontado');
        $this->emitAlert('success', 'Informações atualizadas!');

        $this->closeModal('apontamentoModal');
        $this->reset();
    }
}
