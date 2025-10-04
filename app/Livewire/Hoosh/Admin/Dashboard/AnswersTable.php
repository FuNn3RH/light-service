<?php

namespace App\Livewire\Hoosh\Admin\Dashboard;

use Livewire\Component;
use App\Models\Hoosh\User;
use Livewire\Attributes\On;
use App\Models\Hoosh\Answer;
use App\Models\Hoosh\Question;
use Illuminate\Support\Facades\DB;

class AnswersTable extends Component
{
    public $answers = [];
    public int $filter = 1;


    protected $queryString = [
        'filter' => ['as' => 'filter']
    ];

    public function mount()
    {
        $this->answers = $this->handleFilter($this->filter);
        // dd($this->answers);
    }

    #[On('update-filter')]
    public function updateQuestions($filter)
    {
        $this->filter = $filter;
        $this->answers = $this->handleFilter($this->filter);
    }

    public function handleFilter($filter)
    {
        return match ((int) $filter) {
            1 => $this->getQuestionsWithoutAnswers(),
            2 => $this->getQuestionsWithoutReview(),
            3 => $this->getQuestionsHasReview(),
            default => $this->getQuestionsWithoutAnswers()
        };
    }

    protected function getQuestionsWithoutAnswers()
    {

        return DB::table('hoosh_users')
            ->crossJoin('hoosh_questions')
            ->leftJoin('hoosh_answers', function ($join) {
                $join->on('hoosh_answers.user_id', '=', 'hoosh_users.id')
                    ->on('hoosh_answers.question_id', '=', 'hoosh_questions.id');
            })
            ->leftJoin('hoosh_main_questions', 'hoosh_main_questions.id', '=', 'hoosh_questions.main_question_id')
            ->whereNull('hoosh_answers.id')
            ->whereNot('hoosh_users.role', 'admin')
            ->select([
                'hoosh_users.username',
                'hoosh_questions.id',
                'hoosh_questions.content',
                'hoosh_questions.main_question_id',
                'hoosh_questions.created_at',
                'hoosh_main_questions.title',
            ])
            ->get();
    }

    protected function getQuestionsWithoutReview()
    {
        return Answer::with('question', 'mainQuestion', 'user')
            ->doesntHave('review')
            ->orderByDesc('created_at')
            ->get();
    }

    protected function getQuestionsHasReview()
    {
        return Answer::with('question', 'mainQuestion', 'user')
            ->has('review')
            ->orderByDesc('created_at')
            ->get();
    }

    #[On('delete-answer')]
    public function delete($answerId)
    {
        $answer = Answer::find($answerId);
        if ($answer) {
            $answer->delete();
            session()->flash('message', ['type' => 'success', 'text' => ['پاسخ با موفقیت حذف شد.']]);
            $this->answers = $this->handleFilter($this->filter);
        } else {
            session()->flash('message', ['type' => 'danger', 'text' => ['پاسخ مورد نظر یافت نشد.']]);
        }
    }

    public function render()
    {
        return view('livewire.hoosh.admin.dashboard.answers-table');
    }
}
