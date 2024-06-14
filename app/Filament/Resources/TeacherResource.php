<?php

namespace App\Filament\Resources;

use App\GenderType;
use Filament\Forms;
use App\CivilStatus;
use Filament\Tables;
use App\TeacherStatus;
use App\Models\Teacher;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Contracts\View\View;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TeacherResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TeacherResource\RelationManagers\SubjectsRelationManager;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                ->schema([
                    Forms\Components\FileUpload::make('profile_image')
                    ->image()
                    ->avatar(),
                ]),
                Forms\Components\Section::make()
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('status')
                    ->hidden()
                    ->default(1),
                Forms\Components\TextInput::make('school_id')
                 ->placeholder('Set ID'),
                Forms\Components\TextInput::make('first_name')
                    ->required(),
                Forms\Components\TextInput::make('middle_name'),
                Forms\Components\TextInput::make('last_name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->unique(table: 'teachers', column: 'email', ignoreRecord: true)
                    ->email(),
                Forms\Components\DatePicker::make('birthdate')
                    ->required(),
                Forms\Components\Select::make('gender')
                    ->options(GenderType::class)
                    ->required(),
                Forms\Components\Select::make('civil_status')
                    ->options(CivilStatus::class),
                Forms\Components\TextInput::make('contact_number'),
                Forms\Components\TextInput::make('religion'),
                Forms\Components\TextInput::make('facebook_url'),
                Forms\Components\TextInput::make('purok'),
                Forms\Components\TextInput::make('sitio_street'),
                Forms\Components\TextInput::make('barangay'),
                Forms\Components\TextInput::make('municipality'),
                Forms\Components\TextInput::make('province'),
                Forms\Components\TextInput::make('zip_code')
                    ->numeric(),
                ])



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_image')
                ->alignCenter()
                ->circular()
                ->default(url('/default_images/me.jpg')),
                Tables\Columns\TextColumn::make('status')
                ->hidden()
                    ->sortable(),
                Tables\Columns\TextColumn::make('school_id')
                   ->default('Set ID')
                   ->badge()
                   ->color(
                    fn($state) => match($state){
                        'Set ID' => 'danger',
                        $state => 'primary'
                    }
                   )
                    ->searchable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->sortable(['first_name', 'middle_name', 'last_name'])
                    ->searchable(),
                // Tables\Columns\TextColumn::make('first_name')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('middle_name')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('last_name')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birthdate')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('civil_status')
                //     ->numeric()
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
                ->options(TeacherStatus::class),
                SelectFilter::make('Gender')
                ->options(GenderType::class),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Qr')
                ->icon('heroicon-o-qr-code')
    ->modalContent(fn (Teacher $record): View => view(
        'filament.resources.student-resource.pages.view-qr-code',
        ['record' => $record],
    ))

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
            SubjectsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'view' => Pages\ViewTeacher::route('/{record}'),
            'qr-code' => Pages\ViewQrCode::route('/{record}/qr-code'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
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
