<?php

namespace App\Livewire\Hoosh\Users\MainQuestions;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class MainQuestionList extends Component
{
    #[Title('داشبورد | لیست سوالات')]
    #[Layout('components.hoosh.layouts.app')]
    public function render()
    {
        return view('livewire.hoosh.users.main-questions.main-question-list');
    }
}
