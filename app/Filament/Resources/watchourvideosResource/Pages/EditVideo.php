<?php

namespace App\Filament\Resources\watchourvideosResource\Pages;

use App\Filament\Resources\watchourvideosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVideo extends EditRecord
{
    protected static string $resource = watchourvideosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
