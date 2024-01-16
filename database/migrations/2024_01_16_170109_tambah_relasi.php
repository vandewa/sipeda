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
        Schema::table('pengumpulan_syarats', function (Blueprint $table) {
            $table->foreign('pengumpulan_id')
                ->references('id')->on('pengumpulans')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('pangajuan_syarats', function (Blueprint $table) {
            $table->foreign('pengumpulan_syarat_id')
                ->references('id')->on('pengumpulan_syarats')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('pengajuan_id')
                ->references('id')->on('pengajuans')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumpulan_syarats', function (Blueprint $table) {
            //
        });
    }
};
