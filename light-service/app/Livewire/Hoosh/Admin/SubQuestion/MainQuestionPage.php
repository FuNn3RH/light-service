<?php

namespace App\Livewire\Hoosh\Admin\SubQuestion;

use Livewire\Component;
use App\Models\Hoosh\Question;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Hoosh\MainQuestion;
use Livewire\Attributes\On;

class MainQuestionPage extends Component
{
    public MainQuestion $mainQuestion;


    public function mount(MainQuestion $mainQuestion)
    {
        $this->mainQuestion = $mainQuestion->load('subQuestions');
    }

    #[On('notify')]
    public function showAlert($data)
    {
        session()->flash('message', [
            'type' => $data['type'],
            'text' => $data['text'],
        ]);
    }

    #[Layout('components.hoosh.layouts.app')]
    #[Title('سوالات اصلی')]
    public function render()
    {
        return view('livewire.hoosh.admin.sub-question.main-question-page');
    }
}
