<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->username }}</td>
    <td>{{ __($user->role) }}</td>
    <td>{{ JalaliDate($user->created_at, '%A, %d %B %Y') }}</td>
    <td>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            @if ($user->role !== 'admin')
                <a href="{{ route('hoosh.admin.users.answers', $user->id) }}" class="btn btn-sm btn-primary">پاسخ ها</a>
                <a href="{{ route('hoosh.admin.user-main-questions', $user->id) }}" class="btn btn-sm btn-info">شروع شده
                    ها</a>
            @endif
            <a wire:navigate href="{{ route('hoosh.admin.users.create-edit', $user) }}"
                class="btn btn-sm btn-warning">ویرایش</a>
            @if ($user->role !== 'admin')
                <button wire:confirm='آیا از حذف این کاربر مطمئن هستید؟' wire:click="deleteUser({{ $user->id }})"
                    class="btn btn-sm btn-danger">حذف</button>
            @endif
        </div>
    </td>
</tr>
