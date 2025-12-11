<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kejadian', function (Blueprint $table) {
            // UUID primary key
            $table->uuid('id')->primary();

            $table->string('jenis_kejadian');
            $table->string('objek')->nullable();
            $table->text('lokasi')->nullable();

            // Waktu terkait kejadian
            $table->dateTime('waktu_kejadian')->nullable();
            $table->dateTime('terima_berita')->nullable();
            $table->dateTime('berangkat')->nullable();
            $table->dateTime('tiba_di_lokasi')->nullable();

            // respon_time disimpan sebagai menit
            $table->integer('respon_time')->nullable()
                ->comment('Selisih menit antara tiba_di_lokasi dan berangkat');

            $table->dateTime('kembali_ke_pos')->nullable();

            // Foto
            $table->string('foto')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kejadian');
    }
};
