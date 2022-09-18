<?php

namespace App\Filament\Resources\CategoryJobResource\Pages;

use App\Filament\Resources\CategoryJobResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCategoryJob extends ViewRecord
{
    protected static string $resource = CategoryJobResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
