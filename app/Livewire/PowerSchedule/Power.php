<?php
namespace App\Livewire\PowerSchedule;

use App\Models\PowerSchedule\Power as PowerModel;
use Livewire\Attributes\Title;
use Livewire\Component;

class Power extends Component {
    public $bills = [];

    public function mount() {
        $this->bills = PowerModel::all();
    }

    #[Title('برنامه خاموشی')]
    public function render() {
        return view('livewire.power-schedule.power');
    }
}
