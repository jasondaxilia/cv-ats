<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email', 191)->unique(); // unique identifier
            $table->string('phone', 50)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('country', 100)->nullable();
            $table->string('region', 100)->nullable(); // province/state
            $table->string('city', 100)->nullable();
            $table->string('address_line')->nullable();
            $table->text('summary')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
