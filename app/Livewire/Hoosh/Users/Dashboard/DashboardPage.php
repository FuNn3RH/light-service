<?php

namespace App\Livewire\Hoosh\Users\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class DashboardPage extends Component
{

    #[Title('داشبورد | کاربر')]
    #[Layout('components.hoosh.layouts.app')]
    public function render()
    {
        return view('livewire.hoosh.users.dashboard.dashboard-page');
    }
}
