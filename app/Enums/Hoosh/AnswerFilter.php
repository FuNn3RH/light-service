<?php

namespace App\Enums\Hoosh;

enum AnswerFilter: int
{
    case REVIEWED = 3;
    case UN_REVIEWED = 2;
    case UN_ANSWERED   = 1;

    public function label(): string
    {
        return match ($this) {
            self::REVIEWED => 'reviewed',
            self::UN_REVIEWED => 'un_reviewed',
            self::UN_ANSWERED   => 'un_answered',
        };
    }

    public function class()
    {
        return match ($this) {
            self::REVIEWED => 'btn-success',
            self::UN_REVIEWED => 'btn-warning',
            self::UN_ANSWERED   => 'btn-danger',
        };
    }

    public static function safeFrom(mixed $value): self
    {
        return self::tryFrom((int) $value) ?? self::UN_ANSWERED;
    }
}
