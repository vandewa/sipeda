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
        Schema::create('pengumpulan_syarats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengumpulan_id')->constrained()->onUpdate('cascade')
            ->onDelete('cascade');;
            // $table->unsignedInteger('pengumpulan_id');
            $table->string('name');
            $table->timestamps();

            // $table->foreign('pengumpulan_id')
            // ->references('id')->on('pengumpulans')
            // ->onDelete('cascade')
            // ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumpulan_syarats');
    }
};
