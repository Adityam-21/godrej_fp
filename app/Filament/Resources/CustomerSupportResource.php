<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerSupportResource\Pages;
use App\Filament\Resources\CustomerSupportResource\RelationManagers;
use App\Models\CustomerSupport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\{TextInput, FileUpload, Toggle, Textarea};
use Filament\Tables\Columns\{TextColumn, BooleanColumn, IconColumn, ImageColumn};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerSupportResource extends Resource
{
    protected static ?string $model = CustomerSupport::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('icon')
                    ->directory('support/icons')
                    ->image()
                    ->label('Support Icon'),
                TextInput::make('title')->required(),
                Textarea::make('text')->required()->columnSpanFull(),
                TextInput::make('link')->label('Link')->nullable()->rule('regex:/^(https?:\/\/|tel:|sms:|mailto:|https:\/\/wa\.me\/).+/i'),
                Toggle::make('status')->label('Active')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('icon')->label('Icon'),
                TextColumn::make('title')->searchable(),
                TextColumn::make('text')->limit(50),
                TextColumn::make('link')->label('Link')->copyable()->limit(25)->url(fn($record) => $record->link) // This tells it to use the actual link value->openUrlInNewTab(),                IconColumn::make('status')->label('Active'),
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
            'index' => Pages\ListCustomerSupports::route('/'),
            'create' => Pages\CreateCustomerSupport::route('/create'),
            'edit' => Pages\EditCustomerSupport::route('/{record}/edit'),
        ];
    }
}
