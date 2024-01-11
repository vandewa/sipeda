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
        Schema::create('status_pengajuans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pengajuan_id')->nullable();
            $table->string('pengajuan_tp')->nullable();
            $table->string('posisi_st')->nullable();
            $table->string('status_tp')->nullable();
            $table->longText('keterangan')->nullable();
            $table->bigInteger('oleh')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_pengajuans');
    }
};
