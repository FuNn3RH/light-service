<?php

namespace App\Livewire\Hoosh\Users\MainQuestions;

use App\Models\Hoosh\MainQuestion;
use Livewire\Component;

class QuestionCard extends Component
{
    public MainQuestion $mainQuestion;

    public function mount(MainQuestion $mainQuestion)
    {
        $this->mainQuestion = $mainQuestion;
    }

    public function render()
    {
        return view('livewire.hoosh.users.main-questions.question-card');
    }
}
