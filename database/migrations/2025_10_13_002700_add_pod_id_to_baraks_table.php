<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('baraks', function (Blueprint $table) {
            // BIGINT unsigned supaya cocok dengan id pods (default Laravel)
            $table->unsignedBigInteger('pod_id')->nullable()->after('id');

            // tambahkan FK (opsional, hapus jika DB engine atau nama kolom tidak cocok)
            $table->foreign('pod_id')->references('id')->on('pods')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('baraks', function (Blueprint $table) {
            // drop FK dulu lalu kolom
            $table->dropForeign(['pod_id']);
            $table->dropColumn('pod_id');
        });
    }
};
