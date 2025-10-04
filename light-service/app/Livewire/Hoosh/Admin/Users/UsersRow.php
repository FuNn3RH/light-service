<?php

namespace App\Livewire\Hoosh\Admin\Users;

use App\Livewire\Hoosh\Admin\Users\UsersTable;
use App\Models\Hoosh\User;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class UsersRow extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function deleteUser($userId)
    {
        $this->dispatch('remove-user', userId: $userId);
    }

    public function render()
    {
        return view('livewire.hoosh.admin.users.users-row');
    }
}
