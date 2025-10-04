<?php

namespace App\Livewire\Hoosh\Admin\UserMainQuestion;

use Livewire\Component;
use App\Models\Hoosh\User;
use App\Models\Hoosh\UserMainQuestion;
use Livewire\Attributes\On;

class Table extends Component
{

    public $userMainQuestions = [];
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->userMainQuestions = UserMainQuestion::with('mainQuestion')
            ->where('user_id', $this->user->id)
            ->get();
    }

    #[On('delete')]
    public function delete($userMainQuestionId)
    {
        UserMainQuestion::find($userMainQuestionId)->delete();
        $this->userMainQuestions = UserMainQuestion::with('mainQuestion')
            ->where('user_id', $this->user->id)
            ->get();

        $this->dispatch('notify', ['type' => 'success', 'text' => ['سوال شروع شده با موفقیت حذف شد']]);
    }

    public function render()
    {
        return view('livewire.hoosh.admin.user-main-question.table');
    }
}
