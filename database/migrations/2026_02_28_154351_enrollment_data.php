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
         Schema::create('periods', function (Blueprint $table) {
            $table->id();
            $table->string('period_code')->unique();
            $table->string('name');
            $table->string('year');
            $table->string('term');
            $table->timestamps();
        });
        
        Schema::create('enrollments_data', function (Blueprint $table) {
            $table->id();
            $table->string('period_code', 255);
            $table->foreign('period_code')
                ->references('period_code')
                ->on('periods')
                ->onDelete('restrict');
            $table->string('student_id', 255);
            $table->foreign('student_id')
                ->references('student_id')
                ->on('students')
                ->onDelete('cascade');
            $table->string('subject_code');
            $table->string('subject_grade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'enrollments_data');
        Schema::dropIfExists(table: 'periods');
    }
};
