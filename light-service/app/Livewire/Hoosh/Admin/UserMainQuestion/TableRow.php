<?php

namespace App\Livewire\Hoosh\Admin\UserMainQuestion;

use App\Models\Hoosh\UserMainQuestion;
use Livewire\Component;

class TableRow extends Component
{
    public $userMainQuestion;

    public function mount(UserMainQuestion $userMainQuestion)
    {
        $this->userMainQuestion = $userMainQuestion;
    }

    public function delete()
    {
        $this->dispatch('delete', $this->userMainQuestion->id)->to(Table::class);
    }

    public function render()
    {
        return view('livewire.hoosh.admin.user-main-question.table-row');
    }
}
