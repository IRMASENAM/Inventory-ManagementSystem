<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // migration ini tidak menambah apa-apa,
        // hanya untuk jaga-jaga agar Laravel tahu file ini sudah jalan
    }

    public function down(): void
    {
        /**
         * Drop FK sebelum drop tabel supaya rollback aman
         */

        // barams
        Schema::table('barams', function (Blueprint $table) {
            if (Schema::hasColumn('barams', 'supplier_id')) {
                $table->dropForeign(['supplier_id']);
            }
            if (Schema::hasColumn('barams', 'barang_id')) {
                $table->dropForeign(['barang_id']);
            }
        });
        Schema::dropIfExists('barams');

        // baraks
        Schema::table('baraks', function (Blueprint $table) {
            if (Schema::hasColumn('baraks', 'barang_id')) {
                $table->dropForeign(['barang_id']);
            }
        });
        Schema::dropIfExists('baraks');

        // lapoms
        Schema::table('lapoms', function (Blueprint $table) {
            if (Schema::hasColumn('lapoms', 'baram_id')) {
                $table->dropForeign(['baram_id']);
            }
        });
        Schema::dropIfExists('lapoms');

        // lapoks
        Schema::table('lapoks', function (Blueprint $table) {
            if (Schema::hasColumn('lapoks', 'barak_id')) {
                $table->dropForeign(['barak_id']);
            }
        });
        Schema::dropIfExists('lapoks');

        // sabrangs
        Schema::table('sabrangs', function (Blueprint $table) {
            if (Schema::hasColumn('sabrangs', 'barang_id')) {
                $table->dropForeign(['barang_id']);
            }
        });
        Schema::dropIfExists('sabrangs');

        // jebrangs
        Schema::table('jebrangs', function (Blueprint $table) {
            if (Schema::hasColumn('jebrangs', 'barang_id')) {
                $table->dropForeign(['barang_id']);
            }
        });
        Schema::dropIfExists('jebrangs');

        // equipment_weeks
        Schema::table('equipment_weeks', function (Blueprint $table) {
            if (Schema::hasColumn('equipment_weeks', 'equipment_id')) {
                $table->dropForeign(['equipment_id']);
            }
        });
        Schema::dropIfExists('equipment_weeks');

        // schedules
        Schema::table('schedules', function (Blueprint $table) {
            if (Schema::hasColumn('schedules', 'equipment_id')) {
                $table->dropForeign(['equipment_id']);
            }
        });
        Schema::dropIfExists('schedules');

        // terakhir drop tabel master kalau perlu
        Schema::dropIfExists('equipments');
        Schema::dropIfExists('dabrangs');
        Schema::dropIfExists('suppliers');
    }
};