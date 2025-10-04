<?php

namespace App\Livewire\Hoosh;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{

    public function logout()
    {
        Auth::guard('hoosh')->logout();

        session()->flash('message', ['type' => 'success', 'text' => ['شما با موفقیت خارج شدید.']]);

        return redirect(route('hoosh.login'), true);
    }

    public function render()
    {
        return view('livewire.hoosh.navbar');
    }
}
