<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pada project versi lama, tabel keluhans kadang hanya berisi timestamps saja.
        // Migration ini dibuat robust: jika tabel belum ada, buat dulu.
        if (!Schema::hasTable('keluhans')) {
            Schema::create('keluhans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_petani')->nullable()->constrained('petani')->onDelete('cascade');
                $table->unsignedBigInteger('id_tanaman')->nullable();
                $table->string('judul_keluhan', 255)->nullable();
                $table->text('isi_keluhan')->nullable();
                $table->string('foto_kendala')->nullable();
                $table->timestamp('tanggal_keluhan')->nullable();
                $table->enum('status', ['baru', 'menunggu', 'proses', 'selesai'])->default('baru');
                $table->timestamps();
            });
            return;
        }

        Schema::table('keluhans', function (Blueprint $table) {
            if (!Schema::hasColumn('keluhans', 'id_petani')) {
                $table->foreignId('id_petani')->after('id')->constrained('petani')->onDelete('cascade');
            }

            if (!Schema::hasColumn('keluhans', 'id_tanaman')) {
                $table->unsignedBigInteger('id_tanaman')->nullable()->after('id_petani');
            }

            if (!Schema::hasColumn('keluhans', 'judul_keluhan')) {
                $table->string('judul_keluhan', 255)->after('id_tanaman')->nullable();
            }

            if (!Schema::hasColumn('keluhans', 'isi_keluhan')) {
                $table->text('isi_keluhan')->after('judul_keluhan')->nullable();
            }

            if (!Schema::hasColumn('keluhans', 'foto_kendala')) {
                $table->string('foto_kendala')->nullable()->after('isi_keluhan');
            }

            if (!Schema::hasColumn('keluhans', 'tanggal_keluhan')) {
                $table->timestamp('tanggal_keluhan')->nullable()->after('foto_kendala');
            }

            if (!Schema::hasColumn('keluhans', 'status')) {
                $table->enum('status', ['baru', 'menunggu', 'proses', 'selesai'])
                    ->default('baru')
                    ->after('tanggal_keluhan');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('keluhans')) {
            return;
        }

        Schema::table('keluhans', function (Blueprint $table) {
            $columns = ['id_petani', 'id_tanaman', 'judul_keluhan', 'isi_keluhan', 'foto_kendala', 'tanggal_keluhan', 'status'];
            foreach ($columns as $col) {
                if (Schema::hasColumn('keluhans', $col)) {
                    // catatan: drop foreign key untuk id_petani bisa diperlukan bila ada FK constraint.
                    $table->dropColumn($col);
                }
            }
        });
    }
};

