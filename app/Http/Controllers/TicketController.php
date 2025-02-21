<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\Location;
use App\Models\Subcategory;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Method untuk menampilkan form
    public function index()
    {
        return view('welcome', [
            'offices' => Office::all(),
            'locations' => Location::all(),
            'categories' => Category::all(),
            'subcategories' => Subcategory::all(),
        ]);
    }

    // Simpan data dari form ke database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'office_id' => 'required|exists:offices,id',
            'location_id' => 'required|exists:locations,id',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'deadline' => 'nullable|date',
            'subject' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Ticket::create($validatedData);

        Notification::make()
            ->title('New ticket created')
            ->body("New ticket created by {$validatedData['name']}")
            ->icon('heroicon-o-ticket')
            ->send();

        // Redirect ke form ticket dengan pesan sukses
        return redirect()->route('welcome')->with('success', 'Ticket has been submitted successfully!');
    }

    // Remove atau comment out method list() jika tidak digunakan
    // public function list() {...}
}
