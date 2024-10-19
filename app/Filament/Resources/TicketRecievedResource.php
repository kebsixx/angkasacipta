<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Ticket as TicketRecieved;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\BelongsToSelect;
use App\Filament\Resources\TicketRecievedResource\Pages;

class TicketRecievedResource extends Resource
{
    protected static ?string $model = TicketRecieved::class;
    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';
    protected static ?string $navigationGroup = 'Tickets';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Ticket Received';

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
                        DatePicker::make('deadline')
                            ->label('Deadline')
                            ->native(false),
                        Textarea::make('subject'),
                        Textarea::make('description'),
                        Select::make('status')
                            ->options([
                                'Assigned to Technician' => 'Assigned to Technician',
                                'Ticket Submitted' => 'Ticket Submitted',
                            ])
                            ->required(),
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
                    ->label('Date'),
                TextColumn::make('name')
                    ->label('Nama'),
                TextColumn::make('location.name')
                    ->label('Location'),
                TextColumn::make('category.name')
                    ->label('Category'),
                TextColumn::make('subject'),
                TextColumn::make('status')
                    ->badge()
                    ->icon(fn(string $state): string => match ($state) {
                        'Ticket Submitted' => 'heroicon-o-check-circle',
                        'Assigned to Technician' => 'heroicon-o-clock',
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'Assigned to Technician' => 'warning',
                        'Ticket Submitted' => 'success',
                        default => 'gray',
                    })
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
            'index' => Pages\ListTicketRecieveds::route('/'),
            'create' => Pages\CreateTicketRecieved::route('/create'),
            'edit' => Pages\EditTicketRecieved::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }
}
