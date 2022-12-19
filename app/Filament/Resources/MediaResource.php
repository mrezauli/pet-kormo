<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Filament\Resources\MediaResource\RelationManagers;
use App\Models\Media;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('model_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('model_id')
                    ->required(),
                Forms\Components\TextInput::make('uuid')
                    ->maxLength(36),
                Forms\Components\TextInput::make('collection_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('file_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mime_type')
                    ->maxLength(255),
                Forms\Components\TextInput::make('disk')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('conversions_disk')
                    ->maxLength(255),
                Forms\Components\TextInput::make('size')
                    ->required(),
                Forms\Components\TextInput::make('manipulations')
                    ->required(),
                Forms\Components\TextInput::make('custom_properties')
                    ->required(),
                Forms\Components\TextInput::make('responsive_images')
                    ->required(),
                Forms\Components\TextInput::make('order_column'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('model_type'),
                Tables\Columns\TextColumn::make('model_id'),
                Tables\Columns\TextColumn::make('uuid'),
                Tables\Columns\TextColumn::make('collection_name'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('file_name'),
                Tables\Columns\TextColumn::make('mime_type'),
                Tables\Columns\TextColumn::make('disk'),
                Tables\Columns\TextColumn::make('conversions_disk'),
                Tables\Columns\TextColumn::make('size'),
                Tables\Columns\TextColumn::make('manipulations'),
                Tables\Columns\TextColumn::make('custom_properties'),
                Tables\Columns\TextColumn::make('responsive_images'),
                Tables\Columns\TextColumn::make('order_column'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'view' => Pages\ViewMedia::route('/{record}'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
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
