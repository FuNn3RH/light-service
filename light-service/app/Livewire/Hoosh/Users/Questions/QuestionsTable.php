<?php

namespace App\Livewire\Hoosh\Users\Questions;

use App\Models\Hoosh\MainQuestion;
use Livewire\Component;

class QuestionsTable extends Component
{
    public MainQuestion $mainQuestion;
    public $questions = [];

    public function mount(MainQuestion $mainQuestion)
    {
        $this->questions = $mainQuestion->load(['subQuestions' => function ($query) {
            $query->with(['answers' => function ($q) {
                $q->where('user_id', auth()->guard('hoosh')->id())
                    ->with('review');
            }]);
        }]);
    }

    public function render()
    {
        return view('livewire.hoosh.users.questions.questions-table');
    }
}
