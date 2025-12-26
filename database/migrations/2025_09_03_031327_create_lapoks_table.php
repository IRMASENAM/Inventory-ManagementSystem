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
        Schema::create('lapoks', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_keluar');
            $table->string('no_transaksi');
            $table->string('nama_barang');
            $table->string('jenis_barang');
            $table->string('jumlah_keluar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapoks');
    }
};
