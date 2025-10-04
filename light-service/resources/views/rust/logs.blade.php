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

        <div class="row mt-5">
            <div class="col-12">
                <h2>جستجوگران</h2>
                <div class="d-flex w-100 justify-content-end">
                    <a href="{{ route('rust.treasure.map') }}" class="btn btn-secondary" style="align-self: end">دیدن
                        نقشه</a>
                </div>

                @if (!empty($users))

                    @foreach ($users as $index => $user)
                        <div class="accordion mt-2" id="user{{ $index }}">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fs-4 fw-bold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                        aria-expanded="false" aria-controls="collapse{{ $index }}">
                                        {{ $user['username'] }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                                    data-bs-parent="#user{{ $index }}">
                                    <div class="accordion-body">
                                        @foreach ($user['logs'] as $indexLog => $log)
                                            @if (!empty($log['treasure']) && isset($log['treasure']))
                                                <div>
                                                    <div class="accordion mt-2" id="users_log{{ $indexLog }}">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button collapsed d-flex gap-2"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#collapseLog{{ $indexLog }}"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapseLog{{ $indexLog }}">
                                                                    <span
                                                                        class="text-{{ $log['status'] === 'success' ? 'success' : 'danger' }}">
                                                                        {{ $log->status === 'success' ? $log->treasure->title : 'Failed' }}
                                                                    </span><span style="color: #003cffff;">
                                                                        {{ $log['created_at'] }}
                                                                    </span> </button>
                                                            </h2>
                                                            <div id="collapseLog{{ $indexLog }}"
                                                                class="accordion-collapse collapse"
                                                                data-bs-parent="#users_log{{ $indexLog }}">
                                                                <div class="accordion-body">
                                                                    <div class="mb-2">
                                                                        <strong>سرگذشت:</strong>
                                                                        {{ $log['treasure']['story'] }}
                                                                    </div>

                                                                    <div class="mb-2">
                                                                        <strong>گنجینه قبلی:</strong>
                                                                        {{ $log['treasure']['previous_loot'] }}
                                                                    </div>

                                                                    @if (!empty($log['treasure']['img']))
                                                                        <div class="my-3">
                                                                            <img src="{{ asset('treasures/' . $log['treasure']['img'] . '.png') }}"
                                                                                alt="">
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="accordion-item ">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed d-flex gap-2">
                                                            <span
                                                                class="text-{{ $log['status'] === 'success' ? 'success' : 'danger' }}">
                                                                {{ ucfirst($log['status']) }}
                                                            </span><span style="color: #003cffff;">
                                                                {{ $log['timestamp'] }}
                                                            </span> </button>
                                                    </h2>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No previous attempts found.</p>
                @endif

            </div>
        </div>

    </div>

    <script src="{{ asset('assets/power-schedules/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
