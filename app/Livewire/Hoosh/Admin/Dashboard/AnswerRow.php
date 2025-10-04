<?php

namespace App\Livewire\Hoosh\Admin\Dashboard;

use Livewire\Component;

class AnswerRow extends Component
{
    public $answer;

    public function mount($answer)
    {
        $this->answer = $answer;
    }

    public function delete($answerId)
    {
        $this->dispatch('delete-answer', answerId: $answerId);
    }

    public function render()
    {
        return view('livewire.hoosh.admin.dashboard.answer-row');
    }
}
