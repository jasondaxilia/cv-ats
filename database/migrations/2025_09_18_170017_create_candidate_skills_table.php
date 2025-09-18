<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('candidate_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // contoh: "Laravel", "PHP", "Docker"
            $table->enum('level', ['beginner', 'intermediate', 'advanced', 'expert'])->nullable();
            $table->decimal('years_of_experience', 4, 1)->nullable(); // 0.0 - 999.9
            $table->unsignedSmallInteger('last_used_year')->nullable();
            $table->timestamps();

            $table->unique(['candidate_id', 'name']); // hindari duplikat skill per kandidat
            $table->index(['name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidate_skills');
    }

};
