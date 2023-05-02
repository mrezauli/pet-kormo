<?php

namespace App\Filament\Resources\AgeResource\Pages;

use App\Filament\Resources\AgeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAge extends ViewRecord
{
    protected static string $resource = AgeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
