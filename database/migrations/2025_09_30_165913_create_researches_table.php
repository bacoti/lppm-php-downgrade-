<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('researches', function (Blueprint $table) {
            $table->id();

            $table->foreignId('dosen_id')
                ->nullable()
                ->constrained('dosens')
                ->nullOnDelete();

            $table->string('judul')->nullable();
            $table->string('bidang')->nullable();
            $table->year('tahun')->nullable();
            $table->string('sumber_dana')->nullable();
            $table->decimal('jumlah_dana', 15, 2)->nullable();
            $table->text('abstrak')->nullable();
            $table->string('luaran')->nullable();
            $table->string('file_laporan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('researches');
    }
};
