<?php

namespace App\Livewire\Hoosh\Users\Questions;

use Livewire\Component;
use App\Models\Hoosh\MainQuestion as MainQuestionModel;

class MainQuestion extends Component
{
    public MainQuestionModel $mainQuestion;
    public $showType;

    public function mount(MainQuestionModel $mainQuestion, ?int $showType = 0): void
    {
        $this->mainQuestion = $mainQuestion;

        $this->showType = $showType;
    }

    public function render()
    {
        return view('livewire.hoosh.users.questions.main-question');
    }
}
