<?php

namespace App\Livewire\Hoosh\Admin\Users;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class UsersPage extends Component
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
    #[Title('کاربران')]
    public function render()
    {

        return view('livewire.hoosh.admin.users.users-page');
    }
}
