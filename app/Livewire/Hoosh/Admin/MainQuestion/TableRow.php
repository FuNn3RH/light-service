<?php

namespace App\Livewire\Hoosh\Admin\MainQuestion;

use App\Models\Hoosh\MainQuestion;
use Livewire\Component;

class TableRow extends Component
{
    public $mainQuestion;

    public function mount($mainQuestion)
    {
        $this->mainQuestion = $mainQuestion->loadCount('subQuestions');
    }

    public function delete($mainQuestionId)
    {
        $this->dispatch('delete-main-question', mainQuestionId: $mainQuestionId);
    }

    public function render()
    {
        return view('livewire.hoosh.admin.main-question.table-row');
    }
}
