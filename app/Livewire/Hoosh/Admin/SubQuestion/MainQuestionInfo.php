<?php

namespace App\Livewire\Hoosh\Admin\SubQuestion;

use Livewire\Component;
use App\Models\Hoosh\MainQuestion;

class MainQuestionInfo extends Component
{
    public MainQuestion $mainQuestion;

    public function mount(MainQuestion $mainQuestion)
    {
        $this->mainQuestion = $mainQuestion;
    }

    public function render()
    {
        return view('livewire.hoosh.admin.sub-question.main-question-info');
    }
}
