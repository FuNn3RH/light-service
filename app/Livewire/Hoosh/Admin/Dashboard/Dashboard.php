<?php

namespace App\Livewire\Hoosh\Admin\Dashboard;

use Livewire\Component;
use App\Models\Hoosh\User;
use Livewire\Attributes\On;
use App\Models\Hoosh\Answer;
use App\Models\Hoosh\Question;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    #[Layout('components.hoosh.layouts.app')]
    public function render()
    {
        return view('livewire.hoosh.admin.dashboard.dashboard');
    }
}
