<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryJobResource\Pages;
use App\Filament\Resources\CategoryJobResource\RelationManagers;
use App\Models\CategoryJob;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryJobResource extends Resource
{
    protected static ?string $model = CategoryJob::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('job_id')
                    ->required(),
                Forms\Components\TextInput::make('category_id')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('job_id'),
                Tables\Columns\TextColumn::make('category_id'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCategoryJobs::route('/'),
            'create' => Pages\CreateCategoryJob::route('/create'),
            'view' => Pages\ViewCategoryJob::route('/{record}'),
            'edit' => Pages\EditCategoryJob::route('/{record}/edit'),
        ];
    }    
}
