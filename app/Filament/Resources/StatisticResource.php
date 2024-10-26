<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Ticket;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Faker\Provider\ar_EG\Text;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use pxlrbt\FilamentExcel\Columns\Column;
use Filament\Tables\Actions\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use App\Filament\Exports\TicketByPriorityExporter;
use App\Filament\Resources\StatisticResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class StatisticResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Statistics';

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
                TextColumn::make('subject')
                    ->label('Subject')
                    ->limit(10),
                TextColumn::make('priority')
                    ->label('Priority')
                    ->sortable(),
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
                ExportBulkAction::make()->exports([
                    ExcelExport::make('table')
                        ->fromTable()
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
            'index' => Pages\ListStatistics::route('/'),
            'create' => Pages\CreateStatistic::route('/create'),
            'edit' => Pages\EditStatistic::route('/{record}/edit'),
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

    public static function canEdit(Model $record): bool
    {
        return false;
    }
}
