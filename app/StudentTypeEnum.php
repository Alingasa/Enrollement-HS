<?php

namespace App;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StudentTypeEnum: string implements HasLabel, HasColor
{
    case NEWSTUDENT = '1';
    case OLDSTUDENT = '2';
    case TRANSFEREE = '4';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::NEWSTUDENT    => 'New Student',
            self::OLDSTUDENT    => 'Old Student',
            self::TRANSFEREE    => 'Transferee',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::NEWSTUDENT    => 'success',
            self::OLDSTUDENT    => 'primary',
            self::TRANSFEREE    => 'danger',
        };
    }
}
