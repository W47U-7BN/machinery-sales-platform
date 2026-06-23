<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analytics_page_views', function (Blueprint $table) {
            $table->id();
            $table->string('page_url');
            $table->string('page_title')->nullable();
            $table->foreignId('visitor_id')->nullable()->constrained('analytics_visitors')->nullOnDelete();
            $table->timestamp('viewed_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();

            $table->index('visitor_id');
            $table->index('page_url');
            $table->index('viewed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analytics_page_views');
    }
};
