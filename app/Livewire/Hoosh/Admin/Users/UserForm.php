<?php
namespace App\Livewire\Hoosh\Admin\Users;

use App\Models\Hoosh\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserForm extends Component {

    public $user;
    public $username;
    public $password;
    public $isEdit = false;

    public function mount($user = null) {
        if ($user) {
            $this->user = User::find($user);
            $this->username = $this->user->username;
            $this->isEdit = true;
        }
    }

    public function createUser() {
        $this->validate([
            'username' => 'required|string|min:3|max:255|unique:hoosh_users,username',
            'password' => 'required|string|min:8|max:255',
        ]);

        User::create([
            'username' => $this->username,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('message', ['type' => 'success', 'text' => ['کاربر با موفقیت ایجاد شد.']]);
        return $this->redirect(route('hoosh.admin.users'), true);
    }

    public function updateUser() {
        $this->validate([
            'username' => 'required|string|min:3|max:255|unique:hoosh_users,username,' . $this->user->id,
            'password' => 'nullable|string|min:8|max:255',
        ]);

        $this->user->update([
            'username' => $this->username,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('message', ['type' => 'success', 'text' => ['کاربر با موفقیت ویرایش شد.']]);
        return $this->redirect(route('hoosh.admin.users'), true);
    }

    #[Layout('components.hoosh.layouts.app')]
    #[Title('ایجاد/ویرایش کاربر')]
    public function render() {
        return view('livewire.hoosh.admin.users.user-form');
    }
}
