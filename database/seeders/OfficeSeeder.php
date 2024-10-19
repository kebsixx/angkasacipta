<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offices = [
            'Accounting',
            'CSR & Services',
            'Electrical Instrumental',
            'Finance & Tax',
            'HRD',
            'HSE',
            'IMS',
            'Information Technology',
            'Inspection',
            'Labolatory',
            'Mechanical',
            'Methanol Sales',
            'Methanol SM',
            'MPC',
            'Personel',
            'Personel & GA',
            'Procurement',
            'PSE',
            'Sacurity',
            'Shipping',
            'Strategic',
            'Utility',
            'Warehouse & Recalving',
        ];

        foreach ($offices as $officeName) {
            Office::create([
                'name' => $officeName,
            ]);
        }
    }
}
