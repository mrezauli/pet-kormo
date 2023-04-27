<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Pages\Actions\CreateAction;
use SolutionForest\FilamentTree\Actions;
use SolutionForest\FilamentTree\Concern;
use SolutionForest\FilamentTree\Resources\Pages\TreePage as BasePage;
use SolutionForest\FilamentTree\Support\Utils;

class DumpTreePage extends BasePage
{
    protected static string $resource = CategoryResource::class;

    protected function getActions(): array
    {
        return [
            $this->getCreateAction(),
        ];
    }

    public static function getMaxDepth(): int
    {
        return 2;
    }
}