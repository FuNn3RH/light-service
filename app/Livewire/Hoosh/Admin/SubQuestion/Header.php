<?php

namespace App\Livewire\Hoosh\Admin\SubQuestion;

use App\Models\Hoosh\MainQuestion;
use Livewire\Component;

class Header extends Component
{
    public MainQuestion $mainQuestion;

    public function mount(MainQuestion $mainQuestion)
    {
        $this->mainQuestion = $mainQuestion;
    }

    public function render()
    {
        return view('livewire.hoosh.admin.sub-question.header');
    }
}
