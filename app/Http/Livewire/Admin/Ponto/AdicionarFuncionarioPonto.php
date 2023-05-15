<?php

namespace App\Http\Livewire\Admin\Ponto;

use App\Http\Traits\SwalAlertsTrait;
use App\Models\Funcionario;
use App\Models\Ponto;
use Livewire\Component;

class AdicionarFuncionarioPonto extends Component
{
    use SwalAlertsTrait;

    protected $listeners = [
        'funcionarioAdicionado' => 'render',
        'funcionarioRemovido' => 'render',
    ];

    public Ponto $ponto;
    public $funcionarios;
    public $funcionario;

    public function mount(Ponto $ponto)
    {
        $this->ponto = $ponto;
    }

    public function render()
    {
        $this->funcionarios = Funcionario::where('ativo', true)
            ->whereDoesntHave('pontos', function ($query) {
                $query->where('ponto_id', $this->ponto->id);
            })
            ->orderBy('nome')
            ->get();

        return view('livewire.admin.ponto.adicionar-funcionario-ponto');
    }

    public function adicionar()
    {
        $this->validate();

        $this->ponto->funcionarios()->attach($this->funcionario);

        $this->emit('funcionarioAdicionado');
        $this->funcionario = '';

        $this->emitAlert('success', 'Funcionário adicionado!');
    }

    protected $rules = [
        'funcionario' => ['required', 'exists:funcionarios,id'],
    ];

    protected $messages = [
        'required' => 'O campo :attribute é obrigatório.',
        'exists' => 'O valor selecionado é inválido ou não existe.',
    ];
}
