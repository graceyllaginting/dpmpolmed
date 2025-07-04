<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('structures', function (Blueprint $table) {
            $table->id();
            $table->string('nama_anggota');
            $table->string('jabatan');
            $table->string('bagian')->nullable();       // <- boleh kosong
            $table->string('prodi')->nullable();        // <- boleh kosong
            $table->string('periode');
            $table->string('foto');                     // <- menyimpan nama file atau path
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('structures');
    }
};

