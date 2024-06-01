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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['hadir', 'tidak_hadir','izin']); 
            $table->string("keterangan")->nullable();
            $table->date('tanggal');
            $table->foreignID('user_id')->references('id')->on('users')->onDelete('cascade')->index('user_foreignId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
