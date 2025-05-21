<?php

namespace App\Filament\Resources;

use App\Filament\Imports\UserManualImporter;
use App\Filament\Resources\UserManualResource\Pages;
use App\Filament\Resources\UserManualResource\RelationManagers;
use App\Models\Product;
use Filament\Actions\Concerns\CanImportRecords;
use App\Models\UserManual;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserManualResource extends Resource
{
    protected static ?string $model = UserManual::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('product_id')
                ->relationship('product', 'product_name')
                ->label('product')
                ->required()
                ->searchable(),
            FileUpload::make('image')
                ->image()
                // ->directory('user-manual/images')
                ->nullable(),
            TextInput::make('pdf_title')->required(),
            FileUpload::make('pdf_file')
                ->label('PDF Manual')
                ->required()
                ->directory('user-manual/pdf') // Just directory
                ->disk('public')               // Storage disk
                ->visibility('public'),        // Public access

            Toggle::make('status')->label('Active')->default(true)

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->headerActions([
                ImportAction::make()
                    ->importer(UserManualImporter::class),
            ])

            ->columns([
                TextColumn::make('product.product_name')->label('Product'),
                ImageColumn::make('image'),
                TextColumn::make('pdf_title')->searchable(),
                TextColumn::make('pdf_file')->url('')->label('PDF'),
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
            'index' => Pages\ListUserManuals::route('/'),
            'create' => Pages\CreateUserManual::route('/create'),
            'edit' => Pages\EditUserManual::route('/{record}/edit'),
        ];
    }
}
