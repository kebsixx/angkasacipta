<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Faker\Provider\ar_EG\Text;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Forms\Components\BelongsToSelect;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TicketAssignedResource\Pages;
use App\Filament\Resources\TicketAssignedResource\RelationManagers;

class TicketAssignedResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationLabel = 'Tickets Assign';

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
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID Ticket')
                    ->sortable(),
                SelectColumn::make('priority')
                    ->label('Priority')
                    ->options([
                        'Low' => 'Low',
                        'Medium' => 'Medium',
                        'High' => 'High',
                    ])
                    ->selectablePlaceholder(false),
                TextColumn::make('created_at')
                    ->label('Date'),
                TextColumn::make('deadline')
                    ->label('Deadline')
                    ->dateTime('d-m-Y'),
                TextColumn::make('name')
                    ->label('Name'),
                TextColumn::make('subcategory.name')
                    ->label('Sub Category'),
                TextColumn::make('location.name')
                    ->label('Location'),
                TextColumn::make('subject')
                    ->label('Subject')
                    ->limit(10),
                CheckboxColumn::make('assign') // Toggle untuk mengubah status assign
                    ->label('Assigned')
                    ->default(false),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
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
            'index' => Pages\ListTicketAssigneds::route('/'),
            'create' => Pages\CreateTicketAssigned::route('/create'),
            'edit' => Pages\EditTicketAssigned::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->check() && auth()->user()->hasRole('teknisi');
    }
}
