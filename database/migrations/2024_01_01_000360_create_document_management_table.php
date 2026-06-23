<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_management', function (Blueprint $table) {
            $table->id();
            $table->string('document_number')->nullable();
            $table->string('name');
            $table->string('file');
            $table->string('type')->nullable();
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->string('version')->nullable();
            $table->string('status')->default('draft');
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('type');
            $table->index('category');
            $table->index('status');
            $table->index('uploaded_by');
            $table->index('approved_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_management');
    }
};
