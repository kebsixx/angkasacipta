<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'priority',
        'deadline',
        'office_id',
        'location_id',
        'category_id',
        'subcategory_id',
        'subject',
        'description',
        'progress',
        'status',
        'assign',
    ];

    // Relasi dengan model Office
    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    // Relasi dengan model Location
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    // Relasi dengan model Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi dengan model Subcategory
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
