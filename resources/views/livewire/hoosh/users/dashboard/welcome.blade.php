<div>
    <h4 class="mb-3">خوش آمدی، {{ ucfirst(auth()->guard('hoosh')->user()->username) }}</h4>
    <a href="{{ route('hoosh.users.main-questions') }}" class="btn btn-outline-primary mb-4">جواب دادن به سوالات</a>
</div>
