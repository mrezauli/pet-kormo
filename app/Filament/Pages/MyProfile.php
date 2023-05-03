<?php

namespace App\Filament\Pages;

use JeffGreco13\FilamentBreezy\Pages\MyProfile as BaseProfile;
use JosefBehr\FilamentSpatieMediaLibraryCroppie\Components\SpatieMediaLibraryCroppie;

class MyProfile extends BaseProfile
{
    protected function getUpdateProfileFormSchema(): array
    {
        return array_merge(parent::getUpdateProfileFormSchema(), [
            SpatieMediaLibraryCroppie::make('image')
                ->boundaryWidth('100%')
                ->boundaryHeight('600')
                ->viewportWidth('300')
                ->viewportHeight('300'),
        ]);
    }
}