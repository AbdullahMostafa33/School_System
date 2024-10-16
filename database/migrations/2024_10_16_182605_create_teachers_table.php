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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->text('password');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone', 20);
            $table->smallInteger('religion')->nullable();
            $table->boolean('gender');
            $table->foreignId('nationality_id')->constrained()->onDelete('cascade');
            $table->string('national_id'); 
            $table->date('join_at');           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
