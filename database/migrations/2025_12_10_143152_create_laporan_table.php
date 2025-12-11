<?php
// Migration: database/migrations/2025_12_10_000000_create_laporan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {

            // Primary Key UUID
            $table->uuid('id')->primary();

            // Informasi dasar kejadian
            $table->string('jenis_kejadian')->comment('Jenis atau kategori kejadian');
            $table->string('objek')->nullable()->comment('Objek atau sasaran kejadian');
            $table->text('lokasi')->nullable()->comment('Lokasi kejadian secara lengkap');

            // Waktu kejadian dan proses penanganan
            $table->dateTime('waktu_kejadian')->nullable()->comment('Waktu terjadinya kejadian');
            $table->dateTime('terima_berita')->nullable()->comment('Waktu menerima laporan/berita kejadian');
            $table->dateTime('berangkat')->nullable()->comment('Waktu tim berangkat menuju lokasi');
            $table->dateTime('tiba_di_lokasi')->nullable()->comment('Waktu tim tiba di lokasi kejadian');

            // Selisih waktu (dalam menit)
            $table->integer('respon_waktu')->nullable()
                  ->comment('Selisih menit antara waktu berangkat dan tiba di lokasi');

            $table->dateTime('kembali_ke_pos')->nullable()->comment('Waktu tim kembali ke pos');

            // Foto dokumentasi
            $table->string('foto')->nullable()->comment('Path foto dokumentasi laporan');

            // Timestamps created_at & updated_at
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
