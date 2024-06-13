<?php

namespace App\Filament\Resources;

use App\Status;
use Filament\Forms;
use Filament\Tables;
use App\Models\Student;
use App\Models\Subject;
use Filament\Forms\Form;
use App\Models\Enrollment;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EnrollmentResource\Pages;
use App\Filament\Resources\EnrollmentResource\RelationManagers\SectionRelationManager;
use App\Filament\Resources\EnrollmentResource\RelationManagers\StudentRelationManager;
use App\StudentTypeEnum;

class EnrollmentResource extends Resource
{
    protected static ?string $model = Enrollment::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

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
                    ->afterStateUpdated(function ($state, $set) {
                      $student =  Student::find($state);
                      if($student){
                        $set('student.full_name', $student->full_name);
                        $set('student.strand', $student->strand);
                        $set('student.birthdate', $student->birthdate);
                        $set('student.gender', $student->gender);
                        $set('student.grade_level', $student->grade_level);
                      }
                    } )
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)
                    ->label('Student Enrollee')
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
                        ->relationship(name: 'section')
                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->name)
                        ->required()
                        ->preload()
                        ->live(),
                ]),
                Forms\Components\Section::make('Student')
                    ->columns(2)
                    ->schema([
                    //  Forms\Components\TextInput::make('student.'),
                    // Forms\Components\TextInput::make('student.status')
                    // ->placeholder(Status::PENDING->value)
                    // ->readonly(),
                    Forms\Components\TextInput::make('student.full_name')
                    ->readonly(),
                     Forms\Components\TextInput::make('student.strand')
                     ->placeholder('No Strand')
                     ->readonly(),
                     Forms\Components\TextInput::make('student.birthdate')
                     ->readonly(),
                     Forms\Components\TextInput::make('student.gender')
                     ->readonly(),
                     Forms\Components\TextInput::make('student.grade_level')
                     ->readonly(),

                    //  ->getOptionLabelFromRecordUsing(fn ($record) => $record->full_name)

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
                ->color(fn ($state): string => match($state){
                    'Set ID' => 'danger',
                    $state => 'primary'
                }
                )
                ->badge()
                ->sortable(),
                Tables\Columns\TextColumn::make('student.full_name')
                  ->sortable(['middle_name', 'first_name', 'last_name']),
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
                SelectFilter::make('section_id')
                ->label('By Section')
                ->relationship('section', 'name'),
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
