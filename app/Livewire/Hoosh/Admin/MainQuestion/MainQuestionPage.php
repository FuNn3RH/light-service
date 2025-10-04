<?php

namespace App\Livewire\Hoosh\Admin\MainQuestion;

use Livewire\Component;
use App\Models\Hoosh\Question;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class MainQuestionPage extends Component
{

    protected $listeners = ['notify' => 'showAlert'];

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
        return view('livewire.hoosh.admin.main-question.main-question-page');
    }
}
