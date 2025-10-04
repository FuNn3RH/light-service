<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>Treasure</title>
    <link rel="shortcut icon" href="{{ vAsset('assets/power-schedules/img/rust.png') }}" type="image/png">
    <link href="{{ vAsset('assets/power-schedules/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .checkerboard>div {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container p-5">
        <div class="row">
            <div class="col-3">
                @if (isset($error) && !empty($error))
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endif
                <form method="POST" action="{{ route('rust.treasure.find') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="user_code" class="form-label">رمز شما</label>
                        <input type="text" class="form-control" id="user_code" name="user_code"
                            value="{{ old('user_code') }}">
                        @error('user_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="code" class="form-label">کد گنجینه</label>
                        <input type="text" class="form-control" id="code" name="code"
                            value="{{ old('code') }}">
                        @error('code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">جستجو</button>
                    <a class="btn btn-secondary" target="_blank" href="{{ route('rust.treasure.map') }}">مشاهده نقشه</a>
                </form>
            </div>
        </div>

        @if (isset($mainTreasure) && !empty($mainTreasure))
            <div class="row mt-5">
                <div class="col-12">
                    <h2 style="color:green">گنجینه پیدا شد</h2>
                    <div class="mb-2">
                        <strong>عنوان:</strong>
                        {{ $mainTreasure['title'] }}
                    </div>

                    <div class="mb-2">
                        <strong>سرگذشت:</strong>
                        {{ $mainTreasure['story'] }}
                    </div>

                    <div class="mb-2">
                        <strong>گنجینه قبلی:</strong>
                        {{ $mainTreasure['previous_loots'] }}
                    </div>

                    <div class="mb-2">
                        <strong>آدرس آرک قبل:</strong>
                        {{ $mainTreasure['last_code'] }}
                    </div>

                    <div class="mb-2">
                        <strong>رمز آرک بعدی:</strong>
                        {{ $mainTreasure['next_code'] }}
                    </div>

                    @if (!empty($mainTreasure['img']))
                        <div class="my-3">
                            <img src="{{ asset('treasures/' . $mainTreasure['img'] . '.png') }}" alt="">
                        </div>
                    @endif

                </div>
            </div>

        @endif

        <div class="row mt-5">
            <div class="col-12">

                @if (!empty($userTreasures))
                    <h2>تجربه شما</h2>

                    <div class="accordion" id="accordionExample">
                        @foreach ($userTreasures->logs as $index => $log)
                            <div class="accordion-item mt-2">

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed d-flex gap-2" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseLog{{ $index }}"
                                            aria-expanded="false" aria-controls="collapseLog{{ $index }}">
                                            <span class="text-success">
                                                {{ $log->treasure?->title ?? '' }}
                                            </span>
                                            <span style="color: #003cffff;">
                                                {{ $log->created_at }}
                                            </span>
                                        </button>
                                    </h2>

                                    <div id="collapseLog{{ $index }}" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">

                                            <div class="mb-2">
                                                <strong>سرگذشت:</strong>
                                                {{ $log->treasure->story }}
                                            </div>

                                            <div class="mb-2">
                                                <strong>گنجینه قبلی:</strong>
                                                {{ $log->treasure['previous_loots'] }}
                                            </div>

                                            <div class="mb-2">
                                                <strong>آدرس آرک قبل:</strong>
                                                {{ $log->treasure['last_code'] }}
                                            </div>

                                            <div class="mb-2">
                                                <strong>رمز آرک بعدی:</strong>
                                                {{ $log->treasure['next_code'] }}
                                            </div>

                                            @if (!empty($log->treasure['img']))
                                                <div class="my-3">
                                                    <img src="{{ asset('treasures/' . $log->treasure['img'] . '.png') }}"
                                                        alt="">
                                                </div>
                                            @endif

                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if (!blank($othersTreasures))
                        <div class="mt-3">
                            <h3>تجربه دیگران</h3>
                            <div class="accordion" id="accordionExample2">
                                @foreach ($othersTreasures as $index => $log)
                                    <div class="accordion-item mt-2">

                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed d-flex gap-2" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapsed_other{{ $index }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapsed_other{{ $index }}">
                                                    <span class="mr-3">
                                                        {{ $log->treasure['title'] }}
                                                    </span><span style="color: #003cffff;">
                                                        {{ $log['created_at'] }}
                                                    </span>
                                                </button>
                                            </h2>

                                            <div id="collapsed_other{{ $index }}"
                                                class="accordion-collapse collapse" data-bs-parent="#accordionExample2">
                                                <div class="accordion-body">
                                                    <div class="mb-2">
                                                        <h4>
                                                            ماجراجو:
                                                            <span
                                                                style="color: #003cffff;">{{ $log->user->username }}</span>
                                                        </h4>
                                                    </div>

                                                    <div class="mb-2">
                                                        <strong>سرگذشت:</strong>
                                                        {{ $log->treasure['story'] }}
                                                    </div>

                                                    <div class="mb-2">
                                                        <strong>گنجینه قبلی:</strong>
                                                        {{ $log->treasure['previous_loots'] }}
                                                    </div>

                                                    <div class="mb-2">
                                                        <strong>آدرس آرک قبل:</strong>
                                                        {{ $log->treasure['last_code'] }}
                                                    </div>

                                                    <div class="mb-2">
                                                        <strong>رمز آرک بعدی:</strong>
                                                        {{ $log->treasure['next_code'] }}
                                                    </div>

                                                    @if (!empty($log->treasure['img']))
                                                        <div class="my-3">
                                                            <img src="{{ asset('treasures/' . $log->treasure['img'] . '.png') }}"
                                                                alt="">
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @endif

                @endif

            </div>
        </div>

    </div>

    <script src="{{ vAsset('assets/power-schedules/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
