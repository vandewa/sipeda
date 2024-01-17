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
        Schema::create('pangajuan_syarats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('pengumpulan_syarat_id')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pangajuan_syarats');
    }
};
