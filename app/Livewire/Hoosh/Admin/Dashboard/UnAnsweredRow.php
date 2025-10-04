<?php

namespace App\Livewire\Hoosh\Admin\Dashboard;

use Livewire\Component;

class UnAnsweredRow extends Component
{

    public $question;

    public function mount($question)
    {
        $this->question = $question;
    }

    public function render()
    {
        return view('livewire.hoosh.admin.dashboard.un-answered-row');
    }
}
