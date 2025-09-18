<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
            $table->string('institution');
            $table->string('degree', 100)->nullable();
            $table->string('major', 150)->nullable();
            $table->string('gpa', 20)->nullable();
            $table->year('start_year')->nullable();
            $table->year('end_year')->nullable();
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('order_index')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }

};
