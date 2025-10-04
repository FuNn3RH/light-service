@extends('power-schedule.layouts.master')
@section('head-tags')
    @include('power-schedule.layouts.header')
@endsection
@section('inner_content')
    <div class="location-btn-wrapper">
        <!-- Location Buttons -->
        <div class="d-flex">

            @foreach ($bills as $bill)
                <div class="d-flex align-items-center flex-column gap-2">
                    <button data-engname="{{ $bill['english_title'] }}" data-name="{{ $bill['title'] }}"
                        class="btn location-btn">
                        {{ $bill['title'] }}
                    </button>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Schedule Table -->
    <div class="row mt-1 d-none" id="message">
        <span style="text-align: justify;" class="text-danger">اینترنت شما متصل نیست یا ضعیف هست. ممکن است زمان های
            خاموشی به درستی نمایش داده نشوند.</span>
    </div>
    <div class="row my-1 d-flex justify-content-end d-none" id="notif-container">
        <div>
            <label id="notif-label" class="fs-4" for="notif">🔔</label>
            <input onchange="handleNotificationChange(this)" type="checkbox" id="notif" class="notif-checkbox"
                name="">
        </div>
    </div>

    <div class="schedule-table mt-1 d-none">
    </div>
@endsection

@section('scripts')
    <script>
        var swUrl = @json(route('power-schedules.sw'));
        var url = @json(route('power-schedules.get.reports'))
    </script>
    @include('power-schedule.layouts.footer')
@endsection
