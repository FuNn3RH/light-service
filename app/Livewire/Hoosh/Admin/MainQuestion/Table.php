<?php

namespace App\Livewire\Hoosh\Admin\MainQuestion;

use App\Models\Hoosh\MainQuestion;
use Livewire\Attributes\On;
use Livewire\Component;

class Table extends Component
{

    public $mainQuestions;

    protected $listeners = ['refreshTable' => '$refresh'];

    public function mount()
    {
        $this->mainQuestions = $this->getMainQuestions();
    }

    #[On('delete-main-question')]
    public function delete($mainQuestionId)
    {
        $mainQuestion = MainQuestion::find($mainQuestionId);

        if ($mainQuestion) {
            $mainQuestion->delete();

            $notif = ['type' => 'success', 'text' => ['سوال مورد نظر با موفقیت حذف شد.']];
        } else {
            $notif = ['type' => 'danger', 'text' => ['سوال مورد نظر یافت نشد.']];
        }

        $this->dispatch('notify', $notif);
        $this->mainQuestions = $this->getMainQuestions();
    }

    protected function getMainQuestions()
    {
        return MainQuestion::withCount('subQuestions')->get();
    }

    public function render()
    {
        return view('livewire.hoosh.admin.main-question.table');
    }
}
