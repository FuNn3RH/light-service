<?php

namespace App\Livewire\Hoosh\Users\MainQuestions;

use App\Models\Hoosh\MainQuestion;
use Livewire\Component;

class QuestionCards extends Component
{
    public $mainQuestions;

    public function mount()
    {
        $this->mainQuestions = MainQuestion::withCount([
            'answers' => function ($query) {
                $query->where('user_id', auth()->guard('hoosh')->id());
            },
            'subQuestions'
        ])->has('subQuestions')
            ->orderByDesc('created_at')
            ->get();
    }

    public function render()
    {
        return view('livewire.hoosh.users.main-questions.question-cards');
    }
}
