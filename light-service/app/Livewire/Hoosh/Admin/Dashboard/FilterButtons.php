<?php

namespace App\Livewire\Hoosh\Admin\Dashboard;

use App\Enums\Hoosh\AnswerFilter;
use Livewire\Component;

class FilterButtons extends Component
{
    // keep it primitive
    public int $filter = 1;

    protected $queryString = [
        'filter' => ['as' => 'filter'],
    ];

    public function mount()
    {
        // normalize any inbound value to a valid enum, then store its int value
        $this->filter = AnswerFilter::safeFrom($this->filter ?? 1)->value;
    }

    public function updatedFilter()
    {
        // dispatch the primitive int
        $this->dispatch('update-filter', (int) $this->filter)->to(\App\Livewire\Hoosh\Admin\Dashboard\AnswersTable::class);
    }

    // helper if you want enum internally
    public function enum(): AnswerFilter
    {
        return AnswerFilter::safeFrom($this->filter);
    }

    public function render()
    {
        return view('livewire.hoosh.admin.dashboard.filter-buttons');
    }
}
