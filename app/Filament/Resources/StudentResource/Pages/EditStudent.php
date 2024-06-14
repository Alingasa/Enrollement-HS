<?php

namespace App\Filament\Resources\StudentResource\Pages;

use Filament\Actions;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\StudentResource;

class EditStudent extends EditRecord
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // dd($data);
        if($data['grade_level'] <= 10) {
            $data['strand_id'] = null;
        }
    //    if()
// dd($data);
    // $arr = [7, 8, 9, 10];

    // for($i = 0; $i < count($arr); $i++){
    //        if($record['grade_level']->value == $arr[$i]){
    //          $record['strand_id'] == null;
    //        }
    // }
        // if(!in_array($data('sadfaks'))){
        // };
        // if(!isset($data['strand_id'])){
        //     unset($data['strand_id']);
        // }

        // if($record['strand_id'] == null){
        //     $record['strand_id'] == 'awh';
        // }
        // if($record['record'])
        // dd($record['strand_id']);
        $record->update($data);

        return $record;
    }
}
