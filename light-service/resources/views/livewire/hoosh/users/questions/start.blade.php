<div class="text-center my-4">
    @if ($isAnswered)
        <span class="badge bg-warning text-dark py-2 px-3 fs-5">
            همه‌ی سوال‌ها پاسخ داده شده‌اند
        </span>
    @else
        <a href="{{ route('hoosh.users.start', $mainQuestion->id) }}" class="btn btn-success fs-5 px-4 py-2"
            onclick="return confirm('آیا مطمئن هستید؟ با شروع سوال، دیگر قادر به دیدن متن سوال نیستید!');">
            شروع
        </a>
    @endif
</div>
