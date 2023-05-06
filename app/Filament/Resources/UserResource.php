<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use JosefBehr\FilamentSpatieMediaLibraryCroppie\Components\SpatieMediaLibraryCroppie;
use Spatie\MediaLibrary\Conversions\ImageGenerators\Pdf;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 10 ? 'success' : 'primary';
    }

    // protected function getTableQuery(): Builder
    // {
    //     return parent::getTableQuery()->withoutGlobalScopes();
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryCroppie::make('profile-photo')
                    ->boundaryWidth('472')
                    ->boundaryHeight('590')
                    ->viewportWidth('472')
                    ->viewportHeight('590')
                    ->imageResizeTargetWidth('472')
                    ->imageResizeTargetHeight('590')
                    ->imageResizeMode('cover')
                    //->imageCropAspectRatio('3:2')
                    //->showZoomer()
                    ->modalSize('6xl')
                    ->modalHeading('Crop Profile Photo')
                    ->collection('photos'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Photo Template')
                    ->url(fn (User $record): string => route('user.show', $record))
                    ->color('warning')->size('lg')->icon('heroicon-o-document-download')


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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'photo' => Pages\EditUser::route('/{record}/photo'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('created_by', auth()->id())->orWhere('updated_by', auth()->id());
    }
}