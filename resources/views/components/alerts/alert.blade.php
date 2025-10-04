<div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
    <strong>{{ $title ?? $type == 'success' ? 'موفق!' : 'خطا!' }}</strong>
    @foreach ($messages as $message)
        <div class="my-1">{{ $message }}</div>
    @endforeach
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
