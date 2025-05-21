<?php

namespace App\Filament\Resources\watchourvideosResource\Pages;

use App\Filament\Resources\watchourvideosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVideo extends ListRecords
{
    protected static string $resource = watchourvideosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
