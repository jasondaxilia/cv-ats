<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();

            // File asli
            $table->string('original_filename');
            $table->string('file_path');
            $table->unsignedBigInteger('file_size')->nullable();
            $table->string('file_mime', 100)->default('application/pdf');

            // Metadata & konten
            $table->enum('language', ['id', 'en'])->nullable();
            $table->unsignedSmallInteger('pages_count')->nullable();
            $table->longText('text_content')->nullable();
            $table->json('parsed_json')->nullable();

            // Pipeline parsing & validasi
            $table->enum('parse_status', ['pending', 'processing', 'success', 'failed'])->default('pending');
            $table->timestamp('parsed_at')->nullable();
            $table->string('failed_reason')->nullable();
            $table->string('parser_version', 50)->nullable();

            $table->enum('validation_status', ['unvalidated', 'validated', 'rejected'])->default('unvalidated');
            $table->timestamp('validated_at')->nullable();

            $table->timestamps();

            // 1 resume per kandidat
            $table->unique('candidate_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }

};
