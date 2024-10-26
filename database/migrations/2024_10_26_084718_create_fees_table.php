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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('cost');
            $table->string('year');
            $table->text('notes')->nullable();
            $table->foreignId('stage_id')->nullable()->constrained()->onDelete('cascade');   //null for all stages     
            $table->foreignId('grade_id')->nullable()->constrained()->onDelete('cascade');   //null for all grades 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
