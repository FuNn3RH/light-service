<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
    <h3 class="mb-3 mb-md-0">لیست کاربران</h3>
    <div class="d-flex gap-2">
        <a wire:navigate href="{{ route('hoosh.admin.users.create-edit') }}" class="btn btn-success">+ ایجاد کاربر
            جدید</a>
        <a wire:navigate href="{{ route('hoosh.admin.dashboard') }}" class="btn btn-primary">داشبورد</a>
    </div>
</div>
