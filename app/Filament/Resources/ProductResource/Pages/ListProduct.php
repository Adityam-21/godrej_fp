<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;

class ListProduct extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),

            Actions\Action::make('import')
                ->label('Import')
                ->icon('heroicon-o-arrow-down-tray')
                ->form([
                    FileUpload::make('file')
                        ->label('Upload File')
                        ->acceptedFileTypes(['.csv', '.xlsx'])
                        ->required(),
                ])
                ->action(function (array $data): void {
                    Excel::import(new ProductImport, $data['file']);
                    Notification::make()
                        ->title('Products Imported Successfully')
                        ->success()
                        ->send();
                }),
        ];
    }
}
