<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hapus atau buat pengguna default
        User::truncate(); // Opsional: hapus semua user sebelum seeding

        User::create([
            'name' => 'eltrafo',
            'email' => 'dokumentasieltrafo@gmail.com',
            'password' => Hash::make('P@ssw0rd'),
        ]);

        // Jalankan seeder PlnMemberSeeder
        $this->call([
            PlnMemberSeeder::class,
            // Seeder lain bisa ditulis di sini
        ]);

    }
}
