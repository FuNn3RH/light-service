<!DOCTYPE html>
<html lang="en">

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
<style>
    html,
    body {
        height: 100%;
        margin: 0;

    }

    /* container that either fills whole viewport or uses square sizing */
    .grid-wrap {
        width: 100vw;
        height: 100vh;
        display: grid;
        place-items: stretch;
        background: #111;
    }

    /* square mode: size grid to the smaller viewport side and center it */
    .grid-wrap.square {
        width: min(100vw, 100vh);
        height: min(100vw, 100vh);
        margin: auto;
        /* center in the body */
        box-shadow: 0 0 0 100vmax rgba(0, 0, 0, 0.5);
        /* darken outside area (optional) */
    }

    /* the grid itself: 10 columns, 10 rows */
    .grid {
        display: grid;
        width: 100%;
        height: 100%;
        grid-template-columns: repeat(10, 1fr);
        grid-template-rows: repeat(10, 1fr);
        background-image: url('{{ vAsset('treasures/rust.jpg') }}');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
    }

    /* cell look */
    .cell {
        border: 1px solid rgba(255, 255, 255, 0.06);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        color: rgba(255, 255, 255, 0.85);
        user-select: none;
        font-size: 0.9rem;
        opacity: 0;
    }

    .cell:hover {
        background: rgba(255, 255, 255, 0.06);
        transform: translateY(-2px);
    }

    /* small responsive tweak: hide numbers for very small screens */
    @media (max-width: 420px),
    (max-height: 420px) {
        .cell {
            font-size: 0.6rem;
        }
    }

    .cell.show {
        opacity: 1;
    }
</style>
</head>

<body>

    <div class="grid-wrap">
        <div class="grid">
            @php
                $counter = 0;
            @endphp

            @for ($r = 0; $r < 10; $r++)
                @for ($c = 0; $c < 10; $c++)
                    @php
                        $counter++;
                    @endphp
                    <div class="cell {{ in_array($counter, $locations) ? 'show' : '' }}"
                        data-index="{{ $counter }}">
                        <img style="width: 100%;height: 100%;object-fit: cover;" loading="lazy"
                            src="{{ vAsset("treasures/$counter.png") }}" alt="">
                    </div>
                @endfor
            @endfor
        </div>
    </div>


</body>

</html>
