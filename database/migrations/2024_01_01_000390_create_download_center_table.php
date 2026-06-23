<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('download_center', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string('file');
            $table->string('type')->nullable();
            $table->boolean('is_free')->default(true);
            $table->decimal('price', 15, 2)->nullable();
            $table->integer('download_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('category');
            $table->index('is_active');
            $table->index('is_free');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('download_center');
    }
};
