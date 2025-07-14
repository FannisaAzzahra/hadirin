<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PlnMember;

class PlnMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PlnMember::insert([
            [
                'nama' => 'Budi Santoso',
                'nip' => '123456789',
                'email' => 'budi.santoso@pln.co.id',
                'jabatan' => 'Manager Operasional',
                'no_hp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siti Rahma',
                'nip' => '987654321',
                'email' => 'siti.rahma@pln.co.id',
                'jabatan' => 'Staf Teknik',
                'no_hp' => '082134567891',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Joko Purwanto',
                'nip' => '192837465',
                'email' => 'joko.purwanto@pln.co.id',
                'jabatan' => 'Supervisor Lapangan',
                'no_hp' => '083145678912',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Dewi Lestari',
                'nip' => '564738291',
                'email' => 'dewi.lestari@pln.co.id',
                'jabatan' => 'Administrasi',
                'no_hp' => '084156789123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Andi Wijaya',
                'nip' => '246813579',
                'email' => 'andi.wijaya@pln.co.id',
                'jabatan' => 'Engineer',
                'no_hp' => '085267891234',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Melati Putri',
                'nip' => '135792468',
                'email' => 'melati.putri@pln.co.id',
                'jabatan' => 'Staf Keuangan',
                'no_hp' => '086278912345',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Rudi Hartono',
                'nip' => '102938475',
                'email' => 'rudi.hartono@pln.co.id',
                'jabatan' => 'Asisten Manager',
                'no_hp' => '087289123456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ayu Kartika',
                'nip' => '5647382910',
                'email' => 'ayu.kartika@pln.co.id',
                'jabatan' => 'Staf Administrasi',
                'no_hp' => '088290134567',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Farhan Pratama',
                'nip' => '019283746',
                'email' => 'farhan.pratama@pln.co.id',
                'jabatan' => 'Teknisi Senior',
                'no_hp' => '089301245678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Lina Anggraini',
                'nip' => '847362915',
                'email' => 'lina.anggraini@pln.co.id',
                'jabatan' => 'Quality Control',
                'no_hp' => '081234567891',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
