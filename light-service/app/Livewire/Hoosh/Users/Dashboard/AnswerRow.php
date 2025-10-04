<?php

namespace App\Livewire\Hoosh\Users\Dashboard;

use App\Enums\Hoosh\AnswerStatus;
use Livewire\Component;
use App\Models\Hoosh\Answer;

class AnswerRow extends Component
{
    public Answer $answer;

    public function mount(Answer $answer)
    {
        $this->answer = $answer;
    }

    public function render()
    {
        return view('livewire.hoosh.users.dashboard.answer-row');
    }
}
