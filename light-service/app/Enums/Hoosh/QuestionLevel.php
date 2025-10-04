<?php

namespace App\Enums\Hoosh;

enum QuestionLevel: string
{
    case EASY = 'easy';
    case MEDIUM = 'medium';
    case HARD = 'hard';

    public function label(): string
    {
        return match ($this) {
            self::EASY => 'آسان',
            self::MEDIUM => 'متوسط',
            self::HARD => 'سخت',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::EASY => 'success',
            self::MEDIUM => 'warning',
            self::HARD => 'danger',
        };
    }
}
