<?php

namespace App\Filament\Resources\CategoryJobResource\Pages;

use App\Filament\Resources\CategoryJobResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoryJob extends EditRecord
{
    protected static string $resource = CategoryJobResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
