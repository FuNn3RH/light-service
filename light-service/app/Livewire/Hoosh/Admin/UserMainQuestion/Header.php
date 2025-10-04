<?php

namespace App\Livewire\Hoosh\Admin\UserMainQuestion;

use App\Models\Hoosh\User;
use Livewire\Component;

class Header extends Component
{
    public User $user;

    public function mount(User $user): void
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.hoosh.admin.user-main-question.header');
    }
}
