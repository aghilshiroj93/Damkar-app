<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('petugas')->insert([
            'id' => Str::uuid(),
            'nama_lengkap' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin123'), // jangan lupa ganti!
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
