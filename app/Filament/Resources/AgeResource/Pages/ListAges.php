<?php

namespace App\Filament\Resources\AgeResource\Pages;

use App\Filament\Resources\AgeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAges extends ListRecords
{
    protected static string $resource = AgeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
