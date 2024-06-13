<?php

namespace App\Filament\Resources\EnrollmentResource\Pages;

use Filament\Actions;
use App\Models\Student;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\EnrollmentResource;
use App\Models\Subject;

class EditEnrollment extends EditRecord
{
    protected static string $resource = EnrollmentResource::class;


    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['student'] = Student::find($data['student_id'])->toArray();
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update(Arr::except($data, 'student'));

        return $record;
    }

}
