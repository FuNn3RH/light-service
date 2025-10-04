<div>
    <livewire:hoosh.navbar />

    <div class="container mt-5">
        <h3>ایجاد کاربر</h3>

        <div class="card shadow-sm p-4 mt-4">
            <form wire:submit.prevent="{{ $isEdit ? "updateUser($user->id)" : 'createUser' }}">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">نام کاربری</label>
                        <input type="text" name="username" class="form-control" wire:model="username" />
                        @error('username')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">رمزعبور</label>
                        <input type="password" name="password" class="form-control" wire:model="password" />
                        @error('password')
                            <span class="text-sm text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>


                <div class="mt-3">
                    <button type="submit" class="btn btn-success">{{ $isEdit ? 'ویرایش' : 'ایجاد' }} کاربر</button>
                    <a wire:navigate href="{{ route('hoosh.admin.users') }}" class="btn btn-secondary ms-2">انصراف</a>
                </div>
            </form>
        </div>
    </div>
</div>
