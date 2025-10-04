<tr>
    <td>{{ $userMainQuestion->mainQuestion->title }}</td>
    <td>{{ JalaliDate($userMainQuestion->created_at, '%A, %d %B %Y') }}</td>
    <td>
        <button wire:confirm wire:click="delete" class="btn btn-sm btn-danger">حذف</button>
    </td>
</tr>
