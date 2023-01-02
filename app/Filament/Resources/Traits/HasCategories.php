<?php

namespace App\Filament\Resources\Traits;

use App\Models\Category;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TagsColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Collection;

trait HasCategories

{
    public static function formCategoriesField(): Select
    {
        return self::categoriesField()
            ->relationship('categories', 'name');
    }

    public static function categoriesField(): Select
    {
        return Select::make('categories')
            ->options(Category::pluck('name', 'id'))
            ->multiple()
            ->searchable()
            ->preload()
            ->createOptionForm([
                TextInput::make('name')
                    ->lazy()
                    ->afterStateUpdated(fn ($set, $state) => $set('name', ucfirst($state)))
                    ->required(),
            ]);
    }

    public static function changeCategoriesAction(): BulkAction
    {
        return BulkAction::make('change_categories')
            ->action(function (Collection $records, array $data): void {
                foreach ($records as $record) {
                    $record->categories()->{$data['action']}($data['categories']);
                }
            })
            ->form([
                Grid::make()
                    ->schema([
                        Select::make('action')
                            ->label('For selected records')
                            ->options([
                                'attach' => 'add',
                                'detach' => 'remove',
                                'sync' => 'overwrite',
                            ])
                            ->default('sync')
                            ->required(),

                        self::categoriesField(),

                    ])->columns(2)
            ]);
    }

    public static function categoriesColumn(): TagsColumn
    {
        return TagsColumn::make('categories.name')
            ->limit(3);
    }
}