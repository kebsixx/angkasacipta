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

        $user = User::factory()->create([
            'name' => 'admin',

            'email' => 'admin@test.com',
        ]);
        $role = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $user->assignRole($role);

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
