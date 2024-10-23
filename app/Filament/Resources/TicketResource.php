<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\BelongsToSelect;
use App\Filament\Resources\TicketResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\TicketResource\RelationManagers;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Tickets';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'List Tickets';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama'),
                        BelongsToSelect::make('office_id')
                            ->relationship('office', 'name')
                            ->required(),
                        BelongsToSelect::make('location_id')
                            ->relationship('location', 'name')
                            ->required(),
                        BelongsToSelect::make('category_id')
                            ->relationship('category', 'name')
                            ->required(),
                        BelongsToSelect::make('subcategory_id')
                            ->relationship('subcategory', 'name')
                            ->required(),
                        DateTimePicker::make('deadline')
                            ->label('Deadline')
                            ->native(false),
                        Textarea::make('subject'),
                        Textarea::make('description')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID Ticket'),
                TextColumn::make('created_at')
                    ->label('Date')
                    ->sortable(),
                TextColumn::make('office.name')
                    ->label('Office'),
                TextColumn::make('location.name')
                    ->label('Location'),
                TextColumn::make('category.name')
                    ->label('Category'),
                TextColumn::make('subcategory.name')
                    ->label('Subcategory'),
                TextColumn::make('subject'),
                TextColumn::make('progress')
                    ->label('Progress'),
                TextColumn::make('updated_at')
                    ->label('Last Updated'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
