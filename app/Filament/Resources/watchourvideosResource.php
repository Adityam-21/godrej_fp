<?php

namespace App\Filament\Resources;

use App\Filament\Resources\watchourvideosResourceResource\Products;
use App\Filament\Resources\watchourvideosResourceResource\RelationManagers;
use App\Models\Video;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\{TextInput, Select, FileUpload, Toggle};
use Filament\Tables\Columns\{TextColumn, ImageColumn, BooleanColumn, IconColumn};
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class watchourvideosResource extends Resource
{
    protected static ?string $model = watchourvideosResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('cover_image')->image()->directory('videos/covers'),
                TextInput::make('video_title'),
                TextInput::make('video_link'),
                Select::make('page_id')->relationship('page', 'product_name')->nullable(),
                Toggle::make('status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page.product_name')->label('Page'),
                ImageColumn::make('cover_image')->label('Cover'),
                TextColumn::make('video_title')->searchable(),
                TextColumn::make('video_link')->limit(30)->copyable(),
                IconColumn::make('status')->label('Active'),
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
            'index' => watchourvideosResource\Pages\ListVideo::route('/'),
            'create' => watchourvideosResource\Pages\CreateVideo::route('/create'),
            'edit' => watchourvideosResource\Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
