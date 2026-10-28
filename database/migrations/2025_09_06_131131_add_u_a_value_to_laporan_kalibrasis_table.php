<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('laporan_kalibrasis', function (Blueprint $table) {
        $table->double('u_a_value')->nullable()->after('teknisi');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('laporan_kalibrasis', function (Blueprint $table) {
        $table->dropColumn('u_a_value');
    });
}
};
