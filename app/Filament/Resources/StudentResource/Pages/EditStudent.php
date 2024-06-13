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
    //    if()
// dd($data);
//     $arr = [7, 8, 9, 10];
//     for($i = 0; $i < count($arr); $i++){
//            if($data['grade_level'] == $arr[$i]){
//               return $data;
//            }
//     }
        // if(!in_array($data('sadfaks'))){

        // };
        // if(!isset($data['strand_id'])){
        //     unset($data['strand_id']);
        // }


        $record->update($data);

        return $record;
    }
}
