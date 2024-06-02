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
        Schema::create('class_cash_fund', function (Blueprint $table) {
            $table->id();
            $table->foreignId('students_id')->constrained('students')->onDelete('cascade');
            $table->enum('status', ['paid', 'unpaid']); 
            $table->date('date'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_cash_fund');
    }
};