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
        Schema::table('lapoms', function (Blueprint $table) {
            // hapus kolom string lama
            $table->dropColumn(['nama_supplier', 'nama_barang', 'jenis_barang']);

            // tambahkan relasi ke suppliers
            $table->unsignedBigInteger('supplier_id')->after('no_transaksi');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

            // tambahkan relasi ke dabrangs (master barang)
            $table->unsignedBigInteger('barang_id')->after('supplier_id');
            $table->foreign('barang_id')->references('id')->on('dabrangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lapoms', function (Blueprint $table) {
            // rollback: hapus foreign key dan kolom relasi
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['barang_id']);
            $table->dropColumn(['supplier_id', 'barang_id']);

            // tambahkan kembali kolom string lama
            $table->string('nama_supplier');
            $table->string('nama_barang');
            $table->string('jenis_barang');
        });
    }
};