<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tambah kolom jebrang_id
        Schema::table('dabrangs', function (Blueprint $table) {
            $table->unsignedBigInteger('jebrang_id')->nullable()->after('nama_barang');
        });

        // 2. Isi jebrang_id berdasarkan jenis_barang lama
        $dabrangs = DB::table('dabrangs')->select('id','jenis_barang')->get();
        foreach ($dabrangs as $d) {
            if (!$d->jenis_barang) continue;

            // cari jebrangs.id berdasarkan nama_jenis
            $jebrang = DB::table('jebrangs')->where('nama_jenis', $d->jenis_barang)->first();

            if ($jebrang) {
                DB::table('dabrangs')->where('id', $d->id)->update([
                    'jebrang_id' => $jebrang->id,
                ]);
            }
        }

        // 3. Tambah foreign key
        Schema::table('dabrangs', function (Blueprint $table) {
            $table->foreign('jebrang_id')
                  ->references('id')->on('jebrangs')
                  ->onDelete('set null');
        });

        // 4. Drop kolom lama jenis_barang
        Schema::table('dabrangs', function (Blueprint $table) {
            $table->dropColumn('jenis_barang');
        });
    }

    public function down(): void
    {
        // rollback: tambahkan kembali jenis_barang (varchar) dan hapus FK
        Schema::table('dabrangs', function (Blueprint $table) {
            $table->dropForeign(['jebrang_id']);
            $table->dropColumn('jebrang_id');
            $table->string('jenis_barang')->after('nama_barang');
        });
    }
};