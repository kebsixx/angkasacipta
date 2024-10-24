<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\BelongsToSelect;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ListTicketAssignedResource\Pages;
use App\Filament\Resources\ListTicketAssignedResource\RelationManagers;

class ListTicketAssignedResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';
    protected static ?string $navigationLabel = 'List Tickets Assign';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('id')
                        ->label('ID Ticket')
                        ->disabled(),
                    TextInput::make('priority')
                        ->label('Priority')
                        ->disabled(),
                    TextInput::make('created_at')
                        ->label('Date')
                        ->disabled(),
                    TextInput::make('name')
                        ->label('Nama')
                        ->disabled(),
                    BelongsToSelect::make('subcategory_id')
                        ->relationship('subcategory', 'name')
                        ->disabled(),
                    BelongsToSelect::make('location_id')
                        ->relationship('location', 'name')
                        ->disabled(),
                    TextInput::make('description')
                        ->label('Description')
                        ->disabled(),
                    TextInput::make('progress')
                        ->label('Progress'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID Ticket')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('priority')
                    ->label('Priority'),
                TextColumn::make('created_at')
                    ->label('Date'),
                TextColumn::make('deadline')
                    ->label('Deadline'),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('subcategory.name')
                    ->label('Subcategory')
                    ->searchable(),
                TextColumn::make('location.name')
                    ->label('Location')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Description'),
                TextInputColumn::make('progress')
                    ->label('Progress')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('assign')
                    ->query(fn(Builder $query) => $query->where('assign', true))
                    ->default(),
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
            'index' => Pages\ListListTicketAssigneds::route('/'),
            'create' => Pages\CreateListTicketAssigned::route('/create'),
            'edit' => Pages\EditListTicketAssigned::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->check() && auth()->user()->hasRole('teknisi');
    }

    public static function canView(Model $record): bool
    {
        return auth()->check() && auth()->user()->hasRole('teknisi');
    }

    public static function canUpdate(): bool
    {
        return auth()->check() && auth()->user()->hasRole('teknisi');
    }
}
