<?php

namespace App\Livewire\Hoosh\Users\Answers;

use Livewire\Component;
use App\Models\Hoosh\Answer;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class AnswerPage extends Component
{
    public Answer $answer;

    public function mount(Answer $answer)
    {
        $this->answer = $answer->load('mainQuestion', 'question', 'review');
    }

    #[Title('جزئیات پاسخ')]
    #[Layout('components.hoosh.layouts.app')]
    public function render()
    {
        return view('livewire.hoosh.users.answers.answer-page');
    }
}
