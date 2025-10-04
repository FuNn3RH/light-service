<?php

namespace App\Livewire\Hoosh\Users\Questions;

use App\Models\Hoosh\Question;
use Livewire\Component;

class QuestionsRow extends Component
{
    public $question;
    public $index;

    public function mount($question, $loop)
    {
        $this->question = $question->load(['answer' => function ($query) {
            $query->where('user_id', auth()->guard('hoosh')->id());
        }]);

        $this->index = $loop->iteration;
    }

    public function render()
    {
        return view('livewire.hoosh.users.questions.questions-row');
    }
}
