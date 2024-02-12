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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();

            $table->string('id_laporan')->unique();
            $table->string('kategori');
            $table->string('nama_laporan');
            $table->string('detail_laporan');
            $table->string('alamat_kejadian');
            $table->string('foto');

            // admin modification
            $table->char('status', 1)->nullable();
            $table->string('umpan_balik')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
