<div class="my-3 d-flex justify-content-end gap-1">
    <button class="btn btn-sm btn-secondary {{ (int) $filter === 1 ? 'btn-success' : '' }}"
        wire:click="$set('filter', 1)">بدون
        پاسخ</button>

    <button class="btn btn-sm btn-secondary {{ (int) $filter === 2 ? 'btn-success' : '' }}"
        wire:click="$set('filter', 2)">بدون
        بازخورد</button>

    <button class="btn btn-sm btn-secondary {{ (int) $filter === 3 ? 'btn-success' : '' }}"
        wire:click="$set('filter', 3)">همراه
        بازخورد</button>
</div>
