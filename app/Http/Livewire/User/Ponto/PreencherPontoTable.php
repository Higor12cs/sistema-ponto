<?php

namespace App\Http\Livewire\User\Ponto;

use App\Http\Traits\SwalAlertsTrait;
use App\Models\Ponto;
use Livewire\Component;

class PreencherPontoTable extends Component
{
    use SwalAlertsTrait;

    protected $listeners = [
        'funcionarioApontado' => 'render',
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
        return view('livewire.user.ponto.preencher-ponto-table');
    }
}
