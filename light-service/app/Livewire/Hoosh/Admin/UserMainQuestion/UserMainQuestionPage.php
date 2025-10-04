<?php

namespace App\Livewire\Hoosh\Admin\UserMainQuestion;

use Livewire\Component;
use App\Models\Hoosh\User;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Hoosh\UserMainQuestion;
use Livewire\Attributes\On;

class UserMainQuestionPage extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
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
    #[Title('داشبورد | سوالات شروع شده کاربر')]
    public function render()
    {
        return view('livewire.hoosh.admin.user-main-question.user-main-question-page');
    }
}
