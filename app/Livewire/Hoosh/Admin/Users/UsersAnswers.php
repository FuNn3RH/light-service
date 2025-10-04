<?php

namespace App\Livewire\Hoosh\Admin\Users;

use Livewire\Component;
use App\Models\Hoosh\User;
use App\Models\Hoosh\Answer;
use App\Models\Hoosh\Question;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Hoosh\MainQuestion;
use Illuminate\Support\Collection;

class UsersAnswers extends Component
{
    public User $user;
    public int $type = 4;

    public array $selectedMainQuestions = [];
    public Collection $mainQuestions;
    public Collection $questions;

    public function mount(User $user): void
    {
        $this->user = $user;

        $this->mainQuestions = MainQuestion::withCount('subQuestions')
            ->having('sub_questions_count', '>', 1)
            ->get();

        $this->selectedMainQuestions = $this->mainQuestions->pluck('id')->all();

        $this->allQuestions();
    }

    public function toggleMainQuestion(int $mainQuestionId): void
    {
        if (in_array($mainQuestionId, $this->selectedMainQuestions, true)) {
            $this->selectedMainQuestions = array_values(
                array_filter($this->selectedMainQuestions, fn($id) => (int)$id !== $mainQuestionId)
            );
        } else {
            $this->selectedMainQuestions[] = $mainQuestionId;
        }

        $this->filter($this->type);
    }

    public function updatedType($value): void
    {
        $this->filter((int)$value);
    }

    public function filter(int $type): void
    {
        match ($type) {
            1 => $this->getQuestionsWithoutReview(),
            2 => $this->getQuestionsHasReview(),
            3 => $this->getQuestionsWithoutAnswers(),
            4 => $this->allQuestions(),
            default => $this->allQuestions(),
        };
    }

    protected function getQuestionsWithoutAnswers(): void
    {
        $this->questions = Question::with('mainQuestion')
            ->whereIn('main_question_id', $this->selectedMainQuestions)
            ->whereDoesntHave('answers', function ($query) {
                $query->where('user_id', $this->user->id);
            })
            ->get();
    }

    protected function getQuestionsWithoutReview(): void
    {
        $this->questions = Question::with(['mainQuestion', 'answers' => function ($q) {
            $q->where('user_id', $this->user->id)
                ->with('user'); // optional, if you need user
        }])
            ->whereIn('main_question_id', $this->selectedMainQuestions)
            ->whereHas('answers', function ($q) {
                $q->where('user_id', $this->user->id)
                    ->doesntHave('review');
            })
            ->get();
    }

    protected function getQuestionsHasReview(): void
    {
        $this->questions = Question::with(['mainQuestion', 'answers' => function ($q) {
            $q->where('user_id', $this->user->id)
                ->with(['user', 'review']);
        }])
            ->whereIn('main_question_id', $this->selectedMainQuestions)
            ->whereHas('answers', function ($q) {
                $q->where('user_id', $this->user->id)
                    ->has('review');
            })
            ->get();
    }


    public function allQuestions(): void
    {
        $this->questions = Question::with([
            'mainQuestion',
            'answer' => function ($query) {
                $query->where('user_id', $this->user->id)->with('review');
            },
        ])
            ->whereIn('main_question_id', $this->selectedMainQuestions)
            ->get();
    }

    #[Layout('components.hoosh.layouts.app')]
    #[Title('پاسخ های کاربر')]
    public function render()
    {
        return view('livewire.hoosh.admin.users.users-answers');
    }
}
