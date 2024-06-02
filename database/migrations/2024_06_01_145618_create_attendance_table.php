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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['present', 'absent', 'excused']); 
            $table->string('description')->nullable(); 
            $table->date('date'); 
            $table->time('watcht'); 
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->timestamps();
        });
    }

    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
