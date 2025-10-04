<?php

namespace App\Livewire\Hoosh\Admin\Review;

use Livewire\Component;
use App\Models\Hoosh\Answer;
use Livewire\Attributes\Rule;
use App\Models\Hoosh\Question;
use App\Models\Hoosh\Review;
use Livewire\Attributes\Layout;
use App\Rules\QuestionScoreRule;

class ReviewPage extends Component
{
    public $answer;
    public $score;
    public $feedback;
    protected $filter;

    public function mount($answer = null)
    {
        $this->answer = $answer ? Answer::with('question')->find($answer) : null;

        if (!$this->answer) {
            session()->flash('message', [
                'type' => 'danger',
                'text' => ['پاسخ مورد نظر یافت نشد.']
            ]);

            return $this->redirect(route('hoosh.admin.dashboard'), true);
        }

        $this->score = $this->answer->review['score'] ?? null;
        $this->feedback = $this->answer->review['feedback'] ?? null;
    }

    public function submit()
    {
        $this->validate();

        Review::updateOrCreate(
            ['answer_id' => $this->answer->id],
            [
                'score' => $this->score,
                'feedback' => $this->feedback,
            ]
        );

        session()->flash('message', ['type' => 'success', 'text' => ['پاسخ با موفقیت تصحیح شد.']]);
        $this->redirect(route('hoosh.admin.dashboard'), true);
    }

    protected function rules()
    {
        return [
            'score' => ['required', 'integer', new QuestionScoreRule($this->answer->question->score)],
            'feedback' => ['nullable', 'string', 'max:1000'],
        ];
    }

    #[Layout('بازخورد')]
    #[Layout('components.hoosh.layouts.app')]
    public function render()
    {
        return view('livewire.hoosh.admin.review.review-page');
    }
}
