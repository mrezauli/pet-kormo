<?php

namespace App\Filament\Resources\CategoryJobResource\Pages;

use App\Filament\Resources\CategoryJobResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryJobs extends ListRecords
{
    protected static string $resource = CategoryJobResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
