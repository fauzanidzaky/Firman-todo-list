<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Todo; // <--- WAJIB DIKETIK AGAR MODEL TODO TERBACA

class TodoSeeder extends Seeder
{
    public function run(): void
    {
        // Pembuatan 1 data contoh secara manual (Sesuai slide slide Seeder)
        Todo::create([
            'title' => 'Belajar Laravel',
            'description' => 'Database dan Migration',
            'is_done' => false
        ]);

        // Pembuatan 20 data contoh otomatis acak (Sesuai slide Factory)
        Todo::factory()->count(20)->create();
    }
}