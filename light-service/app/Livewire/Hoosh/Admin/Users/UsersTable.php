<?php

namespace App\Livewire\Hoosh\Admin\Users;

use Livewire\Component;
use App\Models\Hoosh\User;
use Livewire\Attributes\On;

class UsersTable extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::all();
    }

    #[On('remove-user')]
    public function deleteUser($userId)
    {
        $user = User::find($userId);
        $user->delete();

        $this->users = User::all();
        $this->dispatch('notify', ['type' => 'success', 'text' => ['کاربر با موفقیت حذف شد.']]);
    }

    public function render()
    {
        return view('livewire.hoosh.admin.users.users-table');
    }
}
