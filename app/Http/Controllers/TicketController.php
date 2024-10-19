<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\Location;
use App\Models\Subcategory;
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

        // Redirect ke halaman tabel tiket dengan pesan sukses
        return redirect()->route('ticket.list')->with('success', 'Ticket created successfully.');
    }


    public function list()
    {
        // Ambil 10 tiket terbaru dan sertakan relasi
        $tickets = Ticket::with(['office', 'location', 'category', 'subcategory'])
            ->latest('created_at') // Urutkan dari tiket terbaru
            ->take(10) // Batasi hanya 10 tiket terbaru
            ->get();

        return view('tickets.index', compact('tickets'));
    }
}
