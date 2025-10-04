<?php

namespace App\Livewire\Hoosh\Users\Questions;

use App\Models\Hoosh\Answer;
use App\Models\Hoosh\MainQuestion;
use Livewire\Component;

class Start extends Component
{

    public MainQuestion $mainQuestion;
    public $isAnswered;

    public function mount(MainQuestion $mainQuestion): void
    {
        $this->mainQuestion = $mainQuestion;
        $mainQuestion = $mainQuestion->withCount([
            'answers' => function ($query) {
                $query->where('user_id', auth()->guard('hoosh')->id());
            },
            'subQuestions'
        ])
            ->where('id', $mainQuestion->id)->first();

        $this->isAnswered = $mainQuestion->answers_count === $mainQuestion->sub_questions_count;
    }

    public function render()
    {
        return view('livewire.hoosh.users.questions.start');
    }
}
