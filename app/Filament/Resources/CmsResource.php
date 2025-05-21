<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CmsResource\Pages;
use App\Filament\Resources\CmsResource\RelationManagers;
use App\Models\Cms;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\{Select, TextInput, Textarea, Toggle};
use Filament\Tables\Columns\{IconColumn, TextColumn};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CmsResource extends Resource
{
    protected static ?string $model = Cms::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('page_id')
                    ->relationship('page', 'product_name')
                    ->label('Page')
                    ->searchable()
                    ->required(),
                TextInput::make('section_name')->required(),
                TextInput::make('section_title')->label('Section Title')->required(),
                Textarea::make('section_description')->label('Section Description')->nullable()->columnSpanFull(),
                TextInput::make('section_order')->label('Section Order')->default(0)->minValue(0)->required(),
                Toggle::make('status'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page.product_name')->label('Page'), // Shows the page name
                TextColumn::make('section_name')->label('Section Name')->searchable(),
                TextColumn::make('section_title')->label('Section Title'),
                TextColumn::make('section_description')->label('Section Description')->limit(60), // Limits to first 60 characters
                TextColumn::make('section_order')->label('Section Order'),
                TextColumn::make('status')->label('Status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCms::route('/'),
            'create' => Pages\CreateCms::route('/create'),
            'edit' => Pages\EditCms::route('/{record}/edit'),
        ];
    }
}
