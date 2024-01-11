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
        Schema::create('com_regions', function (Blueprint $table) {
            $table->string('region_cd', 20)->primary('com_region_pkey');
            $table->string('region_nm', 100)->nullable();
            $table->string('region_root', 20)->nullable();
            $table->string('region_capital', 1000)->nullable();
            $table->integer('region_level')->nullable();
            $table->char('default_st', 1)->nullable();
            $table->string('postal_cd', 10)->nullable();
            $table->string('modi_id', 20)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('com_regions');
    }
};
