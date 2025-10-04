<?php

namespace App\Livewire\Hoosh\Admin\SubQuestion;

use App\Models\Hoosh\Question;
use Livewire\Component;

class TableRow extends Component
{
    public Question $subQuestion;

    public function mount(Question $subQuestion)
    {
        $this->subQuestion = $subQuestion;
    }

    public function deleteSubQuestion($subQuestionId)
    {
        $this->dispatch('deleteSubQuestion', ['subQuestionId' => $subQuestionId]);
    }

    public function render()
    {
        return view('livewire.hoosh.admin.sub-question.table-row');
    }
}
