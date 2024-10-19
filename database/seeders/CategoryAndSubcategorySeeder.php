<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryAndSubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data kategori
        $categories = [
            'Hardware',
            'Network',
            'Periferal',
            'Request',
            'Service',
            'Software'
        ];

        // Data subkategori
        $subcategories = [
            'Desktop',
            'Laptop',
            'Printer',
            'Server',
            'New User / User Leaving',
            'Data Restore',
            'User / equipment Move or Change',
            'Password Reset',
            'Networking',
            'Email',
            'Internet',
            'Telecommunications',
            'File Storage',
            'Intranet',
            'Printing',
            'Document Management',
            'SAP',
            'PI',
            'Office / Productivity',
            'GDMS',
            'Nisoft',
            'Email outlook',
            'Others'
        ];

        // Membuat kategori
        foreach ($categories as $categoryName) {
            $category = Category::create(['name' => $categoryName]);

            // Untuk setiap kategori, tambahkan 3 subkategori
            foreach (array_slice($subcategories, 0, 3) as $subcategoryName) {
                SubCategory::create([
                    'name' => $subcategoryName,
                    'category_id' => $category->id, // Hubungkan dengan kategori
                ]);
            }

            // Hapus subkategori yang sudah dipakai untuk iterasi berikutnya
            $subcategories = array_slice($subcategories, 3);
        }
    }
}
