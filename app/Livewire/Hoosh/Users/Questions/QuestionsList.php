<?php

namespace App\Livewire\Hoosh\Users\Questions;

use Livewire\Component;

use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Hoosh\MainQuestion;
use Livewire\Attributes\On;

class QuestionsList extends Component
{
    public MainQuestion $mainQuestion;

    public function mount(MainQuestion $mainQuestion): void
    {
        $this->mainQuestion = $mainQuestion;
    }

    #[On('notify')]
    public function showAlert($data)
    {
        session()->flash('message', [
            'type' => $data['type'],
            'text' => $data['text'],
        ]);
    }

    #[Title('داشبورد | لیست زیر سوالات')]
    #[Layout('components.hoosh.layouts.app')]
    public function render()
    {
        return view('livewire.hoosh.users.questions.questions-list');
    }
}
