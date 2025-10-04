<?php

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;
use Illuminate\Http\JsonResponse;

function humanFileSize(int $bytes, int $decimals = 2): string
{
    $size = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen((string) $bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . $size[$factor];
}

function vAsset($path)
{

    $fullPath = public_path($path);
    if (file_exists($fullPath)) {
        $fileName = str($path)->afterLast('/');

        return asset($path) . '?v' . str()->toBase64($fileName);
    }
    return asset($path);
}

function JalaliFormat($date, $format = '%A, %d %B %y')
{
    $date = str_replace('/', '-', $date);
    return Jalalian::fromFormat('Y-m-d', $date)->format($format);
}

function JalaliDate($date, $format = '%Y %B %d')
{
    $jalaliDate = Jalalian::fromDateTime($date);
    return $jalaliDate->format($format);
}

function sortDataByDay($data)
{
    $weekDays = [];

    $firstDayOfWeek = getStartOfWeek(Carbon::now());
    for ($i = 0; $i < 7; $i++) {
        $date = $firstDayOfWeek->copy()->addDays($i);

        $weekDays[strtolower($date->format('l'))] = [
            'time' => [],
            'date' => convertNumbersToPersian(JalaliDate($date->format('Y-m-d'), 'Y/m/d')),
        ];
    }

    if (!isset($data)) {
        return null;
    }

    foreach ($data as $item) {
        $item = (object) $item;
        $day = JalaliFormat($item->outage_date, '%A');
        $day = convertDayToEnglish($day);
        $weekDays[$day]['time'][] = convertNumbersToPersian($item->outage_time);
        $weekDays[$day]['date'] = convertNumbersToPersian($item->outage_date);
    }

    uasort($weekDays, function ($a, $b) {
        return $a['date'] <=> $b['date'];
    });

    return $weekDays;
}

function convertNumbersToPersian($text)
{
    $persian_numbers = [
        '0' => '۰',
        '1' => '۱',
        '2' => '۲',
        '3' => '۳',
        '4' => '۴',
        '5' => '۵',
        '6' => '۶',
        '7' => '۷',
        '8' => '۸',
        '9' => '۹',
    ];

    return strtr($text, $persian_numbers);
}

function convertNumbersToEnglish($text)
{
    $english_numbers = [
        '۰' => '0',
        '۱' => '1',
        '۲' => '2',
        '۳' => '3',
        '۴' => '4',
        '۵' => '5',
        '۶' => '6',
        '۷' => '7',
        '۸' => '8',
        '۹' => '9',
    ];

    return strtr($text, $english_numbers);
}

function convertDayToEnglish($day)
{
    $persian_days = [
        'شنبه' => 'Saturday',
        'یکشنبه' => 'Sunday',
        'دوشنبه' => 'Monday',
        'سه‌شنبه' => 'Tuesday',
        'چهارشنبه' => 'Wednesday',
        'پنج‌شنبه' => 'Thursday',
        'جمعه' => 'Friday',
    ];

    return strtolower($persian_days[$day] ?? $day);
}

function getStartOfWeek(Carbon $date, int $startDayOfWeek = 6): Carbon
{
    $dayOfWeek = $date->dayOfWeek;
    $diff = ($dayOfWeek - $startDayOfWeek + 7) % 7;
    return $date->copy()->subDays($diff);
}

function getFridayTime()
{
    $friday = Carbon::now()->next(Carbon::FRIDAY)->setTime(23, 59, 59);
    return $friday->timestamp;
}

function isAdmin()
{
    return auth()->guard('hoosh')->check() && auth()->guard('hoosh')->user()->role === 'admin';
}


/**
 * Return Jalali formatted date and Persian human diff for a datetime.
 *
 * @param  \DateTime|string|\Carbon\Carbon  $time
 * @param  string|null $format  Jalali format (defaults to 'Y/m/d H:i')
 * @param  string|null $tz  timezone (optional)
 * @return array ['jalali' => string, 'human' => string]
 */
function jalaliHumanDiff($time, $format = 'Y-m-d H:i', ?string $tz = 'Asia/Tehran'): array
{
    // Normalize to Carbon
    if ($time instanceof \Carbon\Carbon) {
        $carbon = $time;
    } elseif ($time instanceof \DateTime) {
        $carbon = Carbon::instance($time);
    } else {
        $carbon = Carbon::parse($time);
    }

    if ($tz) {
        $carbon = $carbon->setTimezone($tz);
    }

    // ensure Persian locale for diff
    Carbon::setLocale('fa');

    // human diff (e.g. "۲ ساعت پیش" or "۳ روز بعد")
    $human = $carbon->diffForHumans();

    // Jalali formatted date (using Morilog\Jalali)
    $jalali = Jalalian::fromCarbon($carbon)->format($format);

    return [
        'jalali' => $jalali,
        'human'  => $human,
    ];
}

function sendResponse($data = [], $message = '', $error = false, $status = 200): JsonResponse
{
    return response()->json(
        [
            'data' => $data,
            'message' => $message,
            'error' => $error,
            'status' => $status,
        ],
        $status,
        [],
        JSON_UNESCAPED_UNICODE
    );
}
