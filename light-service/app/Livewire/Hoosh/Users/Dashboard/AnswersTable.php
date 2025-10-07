<?php

namespace App\Livewire\Hoosh\Users\Dashboard;

use App\Models\Hoosh\Answer;
use Livewire\Component;

class AnswersTable extends Component
{
    public $answers = [];

    public function mount()
    {
        $this->answers = Answer::with('question', 'review')
            ->where('user_id', auth()->guard('hoosh')->id())
            ->orderByDesc('created_at')
            ->get();
    }

    public function render()
    {
        return view('livewire.hoosh.users.dashboard.answers-table');
    }
}
