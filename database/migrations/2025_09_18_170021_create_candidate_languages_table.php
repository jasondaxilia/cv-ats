<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('candidate_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
            $table->string('language'); // e.g., "English", "Indonesian"
            $table->enum('proficiency', ['basic', 'conversational', 'fluent', 'native'])->nullable();
            $table->timestamps();

            $table->unique(['candidate_id', 'language']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidate_languages');
    }

};
