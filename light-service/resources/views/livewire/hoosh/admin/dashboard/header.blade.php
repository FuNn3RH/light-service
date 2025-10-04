<div class="row">
    <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
        <h4 class="mb-3 mb-md-0">جواب های ارسال شده {{ isset($user) && !empty($user) ? ' | ' . $user['username'] : '' }}
        </h4>
        <div class="d-flex gap-2">
            <a wire:navigate class="btn btn-warning" href="{{ route('hoosh.admin.questions.index') }}">لیست سوالات</a>
            @if (isset($user) && !empty($user))
                <a wire:navigate class="btn btn-info"
                    href="{{ route('hoosh.admin.user-main-questions', $user['id']) }}">سوالات شروع
                    شده</a>
            @endif
            <a wire:navigate class="btn btn-primary" href="{{ route('hoosh.admin.users') }}">لیست کاربران</a>
        </div>
    </div>
</div>
