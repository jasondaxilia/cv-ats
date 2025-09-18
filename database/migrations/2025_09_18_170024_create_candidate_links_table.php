<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('candidate_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['linkedin', 'github', 'portfolio', 'website', 'other'])->default('other');
            $table->string('url');
            $table->timestamps();

            $table->index(['candidate_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidate_links');
    }

};
