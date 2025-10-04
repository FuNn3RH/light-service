<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
    <h3 class="mb-3 mb-md-0">زیر سوالات</h3>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('hoosh.admin.questions.sub-questions.create-edit', $mainQuestion['id']) }}"
            class="btn btn-success">+ ایجاد زیر سوال</a>
        <a wire:navigate href="{{ route('hoosh.admin.questions.index') }}" class="btn btn-primary">سوالات</a>
        <a wire:navigate href="{{ route('hoosh.admin.dashboard') }}" class="btn btn-primary">داشبورد</a>
    </div>
</div>
