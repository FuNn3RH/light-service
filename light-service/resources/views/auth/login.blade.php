<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود</title>
    <link rel="stylesheet" href="{{ vAsset('assets/hoosh/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ vAsset('assets/hoosh/css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ vAsset('assets/imgs/customer-service.png') }}">
</head>

<body class="bg-light min-vh-100 d-flex align-items-center justify-content-center">

    <div class="card shadow p-4" style="width: 350px;">

        <h4 class="mb-3 text-center">خوش برگشتی!</h4>
        <form action="{{ route('login.login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username-input" class="form-label">نام کاربری</label>
                <input type="text" name="username" id="username-input" class="form-control"
                    wire:model.defer="username" />
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



    <script src="{{ vAsset('assets/hoosh/js/bootstrap.js') }}"></script>
</body>

</html>
