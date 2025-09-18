<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('resume_stage_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resume_id')->constrained('resumes')->cascadeOnDelete();
            $table->enum('stage', ['uploaded', 'parsed_success', 'parsed_failed', 'validated', 'rejected']);
            $table->string('note')->nullable();
            $table->timestamps(); // created_at = waktu stage dicatat
            $table->index(['resume_id', 'stage']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resume_stage_history');
    }

};
