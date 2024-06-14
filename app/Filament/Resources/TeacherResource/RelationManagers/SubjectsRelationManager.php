<?php

namespace App\Filament\Resources\TeacherResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubjectsRelationManager extends RelationManager
{
    protected static string $relationship = 'subjects';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('subject_code')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('subject_title')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('subject_type')
                    ->options([
                        'Laboratory' => 'Laboratory',
                        'Lecture' => 'Lecture',
                    ])
                    ->required(),
                    Forms\Components\select::make('section_id')
                    ->required()
                    ->relationship(name: 'section', titleAttribute: 'name'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('subject_code')
            ->columns([
                Tables\Columns\TextColumn::make('subject_code'),
                Tables\Columns\TextColumn::make('subject_title'),
                Tables\Columns\TextColumn::make('subject_type'),
                Tables\Columns\TextColumn::make('section.name'),
            ])
            // ->recordTitleAttribute('section_id')
            // ->columns([
            //     Tables\Columns\TextColumn::make('section.name'),
            // ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
