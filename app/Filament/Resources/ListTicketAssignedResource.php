<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
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
                //
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
                TextColumn::make('progress')
                    ->label('Progress')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('assign')
                    ->query(fn(Builder $query) => $query->where('assign', true))
                    ->default(),
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
            'index' => Pages\ListListTicketAssigneds::route('/'),
            'create' => Pages\CreateListTicketAssigned::route('/create'),
            'edit' => Pages\EditListTicketAssigned::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->check() && auth()->user()->hasRole('teknisi');
    }
}
