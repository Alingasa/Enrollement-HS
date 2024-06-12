<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Models\Student;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // $currentYear = Carbon::now()->year;
        // $lastTwoDigits = substr($currentYear, -2);
        // $data['school_id'] = $lastTwoDigits.'-'.str_pad(Student::count() + 1, 4, '0', STR_PAD_LEFT);
        return $data;
    }
}
