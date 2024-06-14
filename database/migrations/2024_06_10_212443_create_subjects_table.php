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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->nullable()->constrained()->cascadeOnUpdate();
            // $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->string('subject_code')->unique();
            $table->string('subject_title');
            $table->foreignId('strand_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->string('subject_type');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('subject_teacher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
