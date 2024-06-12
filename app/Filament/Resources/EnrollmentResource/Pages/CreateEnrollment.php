<?php

namespace App\Filament\Resources\EnrollmentResource\Pages;

use App\Filament\Resources\EnrollmentResource;
use App\Models\Student;
use App\Status;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEnrollment extends CreateRecord
{
    protected static string $resource = EnrollmentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        // dd($data['full_name']);
        $record = Student::find($data['student_id']);
        // dd($record);
        $record->status = Status::ENROLLED;
        $record->save();
        return $data;
    }

}
