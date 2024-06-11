<?php

namespace App\Filament\Resources\SubjectLoadResource\Pages;

use App\Filament\Resources\SubjectLoadResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubjectLoad extends EditRecord
{
    protected static string $resource = SubjectLoadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
