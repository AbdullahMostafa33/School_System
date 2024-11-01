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
        Schema::create('online_classes', function (Blueprint $table) {
            $table->id();
            $table->string('meeting_zoom_id');
            $table->string('name');
            $table->string('title');
            $table->integer('duration');
            $table->dateTime('start_at');
            $table->text('start_url');
            $table->text('join_url');
            $table->foreignId('grade_id')->nullable()->constrained('grades')->cascadeOnDelete()->comment('null for all grades');
            $table->foreignId('classroom_id')->nullable()->constrained('classrooms')->cascadeOnDelete()->comment('null for all classrooms');
            $table->foreignId('specialty_id')->nullable()->constrained('specialties')->cascadeOnDelete()->comment('null for global meeting');
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_classes');
    }
};
