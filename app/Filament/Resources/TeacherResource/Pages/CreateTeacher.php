<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTeacher extends CreateRecord
{
    protected static string $resource = TeacherResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // $emailCreate = strtolower($data['first_name'][0]).'.'.strtolower($data['last_name']).'@mlgcl.edu.ph';

        // User::create([
        //     'name' => $data['first_name'],
        //     'email' => $emailCreate,
        //     'password' => $data['last_name'],
        // ]);
        // return $data;

        $emailBase = strtolower($data['first_name'][0]) . '.' . strtolower($data['last_name']) . '@mlgcl.edu.ph';
        $email = $emailBase;
        $counter = 1;

        while (User::where('email', $email)->exists()) {
            $email = strtolower($data['first_name'][0]) . '.' . strtolower($data['last_name']) . $counter . '@mlgcl.edu.ph';
            $counter++;
        }

        User::create([
            'name' => $data['first_name'],
            'email' => $email,
            'password' => strtolower($data['last_name'],)
        ]);
    //   dd(User::get());
        return $data;
    }

}
