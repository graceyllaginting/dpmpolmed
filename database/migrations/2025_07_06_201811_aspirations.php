<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aspirations', function (Blueprint $table) {
            $table->id('id_aspirasi');
            $table->string('kode_aspirasi')-> unique();
            $table->string('nama_pengirim');
            $table->string('nim');
            $table->string('prodi');
            $table->string('email');
            $table->text('isi_aspirasi');
            $table->enum('status', ['pending', 'ditanggapi', 'selesai'])->default('pending');
            $table->text('tanggapan')->nullable();
            $table->text('balasan_mahasiswa')->nullable();
            $table->date('tanggal_kirim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirations');
    }
};
