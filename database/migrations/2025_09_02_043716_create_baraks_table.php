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
        Schema::create('baraks', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi');
            $table->date('tgl_keluar');
            $table->string('nama_barang');
            $table->integer('jumlah_keluar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baraks');
    }
};
