<?php

namespace App\Livewire\Hoosh\Auth;

use App\Models\Hoosh\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{

    #[Validate('required|string|min:3|max:255|exists:hoosh_users,username')]
    public $username;

    #[Validate('required|string|min:3|max:255')]
    public $password;

    public $successMessages = [];

    public function mount()
    {
        if (Auth::guard('hoosh')->check()) {
            return $this->redirect(route('hoosh.redirect'));
        }
    }

    public function login()
    {
        $this->validate();

        $user = User::where('username', $this->username)
            ->first();

        if (Hash::check($this->password, $user->password)) {
            Auth::guard('hoosh')->login($user, true);
            $this->successMessages[] = 'ورود با موفقیت انجام شد.';

            $this->redirect(route('hoosh.redirect'), true);
        } else {
            $this->addError('username', 'رمز عبور یا نام کاربری نادرست است.');
        }
    }

    #[Layout('components.hoosh.layouts.login.app')]
    #[Title('ورود به حساب کاربری')]
    public function render()
    {
        return view('livewire.hoosh.auth.login');
    }
}
