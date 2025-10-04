<div class="row">
    <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
        <h4 class="mb-3 mb-md-0">سوالات شروع شده | {{ $user->username }}</h4>
        <div class="d-flex gap-2">
            <a class="btn btn-warning" href="{{ route('hoosh.admin.questions.index') }}">لیست سوالات</a>
            <a class="btn btn-primary" href="{{ route('hoosh.admin.users') }}">بازگشت</a>
        </div>
    </div>
</div>
