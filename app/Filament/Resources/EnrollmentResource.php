<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnrollmentResource\Pages;
use App\Filament\Resources\EnrollmentResource\RelationManagers\SectionRelationManager;
use App\Filament\Resources\EnrollmentResource\RelationManagers\StudentRelationManager;
use App\Models\Enrollment;
use App\Models\Student;
use App\Status;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnrollmentResource extends Resource
{
    protected static ?string $model = Enrollment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                ->columns(2)
                ->schema([
                    Forms\Components\Select::make('student_id')
                    ->relationship(
                        name: 'student',
                        ignoreRecord: true,
                        modifyQueryUsing: function ($query) {
                            $query->where('status', Status::PENDING);
                        }
                    )
                    ->afterStateUpdated(fn ($state) => Student::find($state))
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                    ->label('Student ID')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->live()
                    ->hiddenOn('edit'),

                    //  ->visible(fn ($get, $operation) => ($operation == 'edit') && in_array($get('status'), [
                    //     Status::ENROLLED->value,
                    //  ])),
                    Forms\Components\Select::make('section_id')
                        ->searchable()
                        ->preload()
                        ->relationship(name: 'section', titleAttribute: 'name')
                        ->required(),
                ]),
                Forms\Components\Section::make()
                    ->schema([
                     Forms\Components\TextInput::make('First Name')
                     ->dehydrateStateUsing(fn (string $state): string => dd($state))

                    ])
                    ->visible(fn ($get) => !empty($get('student_id'))),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('student.profile_image')
                ->defaultImageUrl(url('default_images/me.jpg'))
                ->alignCenter()
                ->circular(),
                Tables\Columns\TextColumn::make('student.school_id')
                ->label('School ID')
                ->default('Set ID')
                ->badge()
                ->sortable(),
                Tables\Columns\TextColumn::make('student.full_name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('section.name')
                    ->searchable()
                    ->sortable(),
                // Tables\Columns\SelectColumn::make('section.subjects.')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            SectionRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEnrollments::route('/'),
            'create' => Pages\CreateEnrollment::route('/create'),
            // 'view' => Pages\ViewEnrollment::route('/{record}'),
            'edit' => Pages\EditEnrollment::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
