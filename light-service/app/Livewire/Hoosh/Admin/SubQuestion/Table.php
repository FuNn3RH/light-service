<?php

namespace App\Livewire\Hoosh\Admin\SubQuestion;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Hoosh\Question;
use App\Models\Hoosh\MainQuestion;
use Illuminate\Database\Eloquent\Collection;

class Table extends Component
{
    public Collection $subQuestions;
    public MainQuestion $mainQuestion;

    public function mount(MainQuestion $mainQuestion)
    {
        $this->mainQuestion = $mainQuestion;
        $this->subQuestions = $this->getSubQuestions();
    }

    #[On('deleteSubQuestion')]
    public function deleteSubQuestion($subQuestionId)
    {
        $subQuestion = Question::where('id', $subQuestionId)->first();


        if ($subQuestion) {
            $subQuestion->delete();

            $notif = ['type' => 'success', 'text' => ['سوال مورد نظر با موفقیت حذف شد.']];
        } else {
            $notif = ['type' => 'danger', 'text' => ['سوال مورد نظر یافت نشد.']];
        }
        $this->subQuestions = $this->getSubQuestions();

        $this->dispatch('notify', $notif);
    }

    protected function getSubQuestions()
    {
        return Question::where('main_question_id', $this->mainQuestion->id)->get();
    }

    public function render()
    {
        return view('livewire.hoosh.admin.sub-question.table');
    }
}
