<?php

namespace App\Enums\Hoosh;

enum AnswerStatus: string
{
    case REVIEWED = 'reviewed';
    case UN_REVIEWED = 'un_reviewed';

    public function class()
    {
        return match ($this) {
            self::REVIEWED => 'bg-success',
            self::UN_REVIEWED => "bg-warning text-dark"
        };
    }

    public function label()
    {
        return match ($this) {
            self::REVIEWED => 'تصحیح شده',
            self::UN_REVIEWED => "تصحیح نشده"
        };
    }
}
