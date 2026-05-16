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
    Schema::table('keluhans', function (Blueprint $table) {
        // Kolom FK harus konsisten dengan code/model: `id_petani`
        $table->foreignId('id_petani')->after('id')->constrained('petani')->onDelete('cascade');
        $table->timestamp('tanggal_keluhan')->after('id_petani')->useCurrent();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keluhans', function (Blueprint $table) {
            //
        });
    }
};
