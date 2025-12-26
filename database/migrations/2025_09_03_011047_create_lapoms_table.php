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
        Schema::create('lapoms', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_masuk');
            $table->string('no_transaksi');
            $table->string('nama_supplier');
            $table->string('nama_barang');
            $table->string('jenis_barang');
            $table->integer('jumlah_masuk');
            $table->decimal('harga_beli', 10, 2);
            $table->decimal('total_harga', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapoms');
    }
};
