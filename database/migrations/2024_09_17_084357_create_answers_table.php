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
        Schema::create('answers', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('student_id');
        $table->unsignedBigInteger('question_id');
        $table->integer('selected_answer'); // قيمة الإجابة المختارة
        $table->boolean('is_correct')->nullable(); // عمود لحفظ حالة الإجابة

        $table->timestamps();

        $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
        $table->foreign('question_id')->references('id')->on('questions')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
