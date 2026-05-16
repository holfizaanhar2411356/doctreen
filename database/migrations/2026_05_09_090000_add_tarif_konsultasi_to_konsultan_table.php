<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('konsultan', function (Blueprint $table) {
            // tarif_konsultasi dalam satuan "ribu"
            $table->unsignedInteger('tarif_konsultasi')->default(0)->after('keahlian');
        });
    }

    public function down(): void
    {
        Schema::table('konsultan', function (Blueprint $table) {
            $table->dropColumn('tarif_konsultasi');
        });
    }
};

