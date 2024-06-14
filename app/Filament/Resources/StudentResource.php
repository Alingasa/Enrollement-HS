<?php

namespace App\Filament\Resources;

use App\Status;
use App\GradeType;
use App\GenderType;
use Filament\Forms;
use App\CivilStatus;
use Filament\Tables;
use App\Models\Student;
use App\StudentTypeEnum;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Contracts\View\View;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\StudentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StudentResource\RelationManagers;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                ->columns(2)
                ->schema([
                    Forms\Components\FileUpload::make('profile_image')
                    ->avatar()
                    ->previewable()
                    ->imagePreviewHeight(500)
                    ->imageEditor()
                    ->image(),
                ]),
                Forms\Components\Section::make('Student Details')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('school_id')
                    ->placeholder('Set ID')
                    ->label('Shool ID')
                    ->visible(fn ($get, $operation) => ($operation == 'edit') && in_array($get('status'), [
                        Status::ENROLLED->value,
                    ]))
                    ->unique(table: 'students', column: 'school_id', ignoreRecord: true),
                Forms\Components\select::make('grade_level')
                ->live()
                ->required()
                ->options(GradeType::class),
                Forms\Components\Select::make('strand_id')
                ->relationship(name: 'strand', titleAttribute: 'name' )
                ->searchable()
                ->visible(fn ($get, $operation) => ($operation == 'edit' || $operation == 'create') && in_array($get('grade_level'), [
                    GradeType::GRADE11->value,
                    GradeType::GRADE12->value,
                ]))
                ->required()
                ->preload(),
                Forms\Components\TextInput::make('first_name')
                    ->required(),
                Forms\Components\TextInput::make('middle_name'),
                Forms\Components\TextInput::make('last_name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->unique(table: 'students', column: 'email', ignoreRecord: true)
                    ->email(),
                Forms\Components\DatePicker::make('birthdate')
                    ->required(),
                Forms\Components\select::make('gender')
                    ->required()
                    ->options(GenderType::class),
                Forms\Components\select::make('civil_status')
                    ->required()
                    ->options(CivilStatus::class),
                Forms\Components\TextInput::make('contact_number')
                ->numeric()
                ->required(),
                Forms\Components\TextInput::make('religion')
                ->required(),
                // Forms\Components\TextInput::make('facebook_url')
                // ->required()
                // ->placeholder('Optional'),
                Forms\Components\TextInput::make('purok')
                ->required(),
                Forms\Components\TextInput::make('sitio_street')
                ->required(),
                Forms\Components\TextInput::make('barangay')
                ->required(),
                Forms\Components\TextInput::make('municipality')
                ->required(),
                Forms\Components\TextInput::make('province')
                ->required(),
                Forms\Components\TextInput::make('zip_code')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('guardian_name')
                ->label('Guardian Name/Parent Name')
                ->required(),
                // Forms\Components\TextInput::make('LRN')
                // ->placeholder('Optional'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('profile_image')
                ->defaultImageUrl(url('default_images/me.jpg'))
                ->alignCenter()
                ->circular(),
                Tables\Columns\TextColumn::make('strand.name')
                    ->default('No Strand')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                         'No Strand' => 'danger',
                          $state => 'warning',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('school_id')
                    ->badge()
                    ->default('Set ID')
                    ->color(fn ($state): string => match($state){
                        'Set ID' => 'danger',
                         $state => 'primary'
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(['middle_name', 'first_name', 'last_name'])
                    ->sortable(['middle_name', 'first_name', 'last_name']),
                // Tables\Columns\TextColumn::make('first_name')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('middle_name')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('last_name')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('email')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('birthdate')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('grade_level')
                    ->sortable(),
                // Tables\Columns\TextColumn::make('civil_status')
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('contact_number')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('religion')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('facebook_url')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('purok')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('sitio_street')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('barangay')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('municipality')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('province')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('zip_code')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('guardian_name')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('LRN')
                //     ->searchable(),

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
                SelectFilter::make('Status')
                ->options(Status::class),
                SelectFilter::make('grade_level')
                ->options(GradeType::class),
                SelectFilter::make('strand_id')
                ->label('By Strands')
                ->relationship('strand', 'name'),

            ], layout: FiltersLayout::AboveContentCollapsible)
            ->defaultSort('full_name', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                // Tables\Actions\Action::make('Qr')
                // ->icon('heroicon-o-qr-code')
                // ->url(fn (Student $record) => static::getUrl('qr-code', [$record])),

                Tables\Actions\Action::make('Qr')
                ->icon('heroicon-o-qr-code')
    ->modalContent(fn (Student $record): View => view(
        'filament.resources.student-resource.pages.view-qr-code',
        ['record' => $record],
    ))
    ->modalSubmitAction(false)
    // ->cancelParentActions()
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'view' => Pages\ViewStudent::route('/{record}'),
            'qr-code' => Pages\ViewQrCode::route('/{record}/qr-code'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
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
