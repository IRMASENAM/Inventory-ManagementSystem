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
        Schema::create('pods', function (Blueprint $table) {
            $table->id();

            // Informasi utama POD
            $table->string('kode_auto', 20)->nullable();      // Contoh: POD-001
            $table->string('kode_manual', 20)->nullable();    // Contoh: 11274
            $table->string('nomor_pod', 50)->unique();        // Hasil gabungan: POD-001-11274
            $table->date('tanggal');                          // Tanggal kegiatan POD
            $table->string('jenis_pod', 50)->nullable();      // Rutin / Tambahan / Helpdesk

            // Identitas pembuat POD
            $table->string('dibuat_oleh', 100)->nullable();   // Nama pembuat laporan
            $table->string('departemen', 100)->nullable();    // Unit kerja / divisi
            $table->string('lokasi', 100)->nullable();        // Lokasi kegiatan (Boiler, LT.8, dll)

            // Isi utama laporan
            $table->text('daftar_pekerjaan')->nullable();     // List kegiatan POD
            $table->longText('uraian')->nullable();           // Detail tambahan (helpdesk, tiket, dll)

            // Integrasi ke sistem Eksintas
            $table->string('kode_transaksi', 50)->nullable(); // Relasi opsional ke transaksi keluar
            $table->string('lampiran')->nullable();           // Path file lampiran (foto/pdf)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pods');
    }
};