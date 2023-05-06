<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-finger-print';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('short_description')
                    ->maxLength(250),
                Forms\Components\Textarea::make('full_description'),
                Forms\Components\TextInput::make('job_nature')
                    ->maxLength(50),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255),
                Forms\Components\Toggle::make('top_rated'),
                Forms\Components\TextInput::make('count_of_post')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('location_id')
                    ->relationship('location', 'name'),
                Forms\Components\Select::make('company_id')
                    ->relationship('company', 'name'),
                Forms\Components\Select::make('designation_id')
                    ->relationship('designation', 'name'),
                Forms\Components\Select::make('grade_id')
                    ->relationship('grade', 'name'),
                Forms\Components\Select::make('age_id')
                    ->relationship('age', 'years'),
                Select::make('requirements')
                    ->multiple()
                    ->relationship('requirements', 'title'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('short_description'),
                Tables\Columns\TextColumn::make('full_description'),
                Tables\Columns\TextColumn::make('job_nature'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\IconColumn::make('top_rated')
                    ->boolean(),
                Tables\Columns\TextColumn::make('count_of_post'),
                Tables\Columns\TextColumn::make('location.name'),
                Tables\Columns\TextColumn::make('company.name'),
                Tables\Columns\TextColumn::make('designation.name'),
                Tables\Columns\TextColumn::make('grade.name'),
                Tables\Columns\TextColumn::make('age.years'),
                Tables\Columns\TextColumn::make('requirements.title'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'view' => Pages\ViewJob::route('/{record}'),
            'edit' => Pages\EditJob::route('/{record}/edit'),
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