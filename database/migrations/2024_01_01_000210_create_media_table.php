<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->morphs('mediable');
            $table->string('collection_name');
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->string('disk')->default('public');
            $table->unsignedBigInteger('size')->default(0);
            $table->integer('sort_order')->default(0);
            $table->json('custom_properties')->nullable();
            $table->timestamps();

            $table->index(['mediable_id', 'mediable_type']);
            $table->index('collection_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
