<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Membuat user dengan role 'admin'
        $adminUser = User::factory()->create([
            'name' => 'adi',
            'username' => 'admin',
            'email' => 'admin@test.com',
        ]);

        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $adminUser->assignRole($adminRole);

        // Membuat user dengan role 'teknisi'
        $technicianUser = User::factory()->create([
            'name' => 'budi',
            'username' => 'technician',
            'email' => 'technician@test.com',
        ]);

        $technicianRole = Role::create(['name' => 'teknisi', 'guard_name' => 'web']);
        $technicianUser->assignRole($technicianRole);

        $this->call([
            OfficeSeeder::class, // Jalankan seeder office
        ]);

        $this->call([
            LocationSeeder::class, // Jalankan seeder lokasi
        ]);

        $this->call([
            CategoryAndSubcategorySeeder::class,
        ]);
    }
}
