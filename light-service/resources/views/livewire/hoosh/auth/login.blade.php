<div class="card shadow p-4" style="width: 350px;">

    @if (!blank($successMessages))
        <x-alert :type="'success'" :messages="$successMessages"></x-alert>
    @endif

    <h4 class="mb-3 text-center">خوش برگشتی!</h4>
    <form wire:submit.prevent="login">
        <div class="mb-3">
            <label for="username-input" class="form-label">نام کاربری</label>
            <input type="text" name="username" id="username-input" class="form-control" wire:model.defer="username" />
            @error('username')
                <span class="text-sm text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password-input" class="form-label">رمز عبور</label>
            <input type="password" name="password" id="password-input" class="form-control"
                wire:model.defer="password" />
            @error('password')
                <span class="text-sm text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button wire:loading.attr="disabled" wire:target="login" type="submit"
            class="btn btn-primary w-100">ورود</button>
    </form>
</div>
