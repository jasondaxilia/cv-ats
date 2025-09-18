<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
            $table->string('company');
            $table->string('title');
            $table->string('employment_type', 50)->nullable(); // Full-time/Part-time/Contract
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false);
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->text('achievements')->nullable();
            $table->unsignedSmallInteger('order_index')->default(0);
            $table->timestamps();

            $table->index(['candidate_id', 'start_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }

};
