<?php

namespace App\Livewire;


use App\Models\Ticket;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Components\Card;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateTicket extends Component implements HasForms
{
    use InteractsWithForms;

    public $name = '';
    public $office_id = '';
    public $location_id = '';
    public $category_id = '';
    public $subcategory_id = '';
    public $deadline = '';
    public $subject = '';
    public $description = '';


    public function form(Form $form): Form
    {
        return $form
    ->schema([
        Card::make()
            ->schema([
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),
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
                    ->native(false)
                    ->required(),
                Textarea::make('subject')
                    ->label('Subject')
                    ->required(),
                Textarea::make('description')
                    ->label('Description'),
            ]),
    ]);

    }

    public function render()
    {
        return view('livewire.create-ticket');
    }

    public function save(): void
    {
        dd(Ticket::with(['office', 'location', 'category', 'subcategory'])->first());

        dd($this->forms()->getState());
    }
}
