<?php

namespace App\Filament\Resources;

use App\Models\Job;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\JobResource\Pages;
use App\Filament\Resources\Traits\HasCategories;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\JobResource\RelationManagers;

class JobResource extends Resource
{
    use HasCategories;
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
                Forms\Components\Textarea::make('requirements'),
                Forms\Components\TextInput::make('job_nature')
                    ->maxLength(50),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255),
                Forms\Components\Toggle::make('top_rated'),
                Forms\Components\TextInput::make('salary')
                    ->numeric()
                    ->required(),
                Select::make('locationId')
                    ->relationship('location', 'name')->required(),
                Select::make('companyId')
                    ->relationship('company', 'name')->required(),
                self::formCategoriesField(), //you can add of course extra settings which you need in given resource
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('short_description'),
                Tables\Columns\TextColumn::make('full_description'),
                Tables\Columns\TextColumn::make('requirements'),
                Tables\Columns\TextColumn::make('job_nature'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\IconColumn::make('top_rated')
                    ->boolean(),
                Tables\Columns\TextColumn::make('salary'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('location.name'),
                Tables\Columns\TextColumn::make('company.name'),
                self::categoriesColumn(),
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
                self::changeCategoriesAction(),
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
