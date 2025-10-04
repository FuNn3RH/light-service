<?php

namespace App\Livewire\Hoosh\Admin\Users;

use Livewire\Component;

class UsersChart extends Component
{
    public array $chartData = [];

    public function mount($mainQuestions)
    {
        $this->chartData['labels'] = collect($mainQuestions)->pluck('title');

        foreach ($mainQuestions as $mainQuestion) {
            foreach ($mainQuestion['users'] as $user) {
                $this->chartData['user_data'][$user['username']][] = $user['percent'];
            }
        }
    }

    public function render()
    {
        return view('livewire.hoosh.admin.users.users-chart');
    }
}
