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
        Schema::create('pengajuan_syarat_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pangajuan_syarat_id');
            $table->unsignedBigInteger('pengajuan_id');
            $table->unsignedBigInteger('pengumpulan_syarat_id');
            $table->string('path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_syarat_histories');
    }
};
