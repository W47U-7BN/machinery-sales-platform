<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dealer_targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dealer_id')->constrained('dealer_information')->cascadeOnDelete();
            $table->decimal('target_amount', 15, 2)->default(0);
            $table->string('period')->default('month');
            $table->year('year');
            $table->integer('month')->nullable();
            $table->decimal('achieved_amount', 15, 2)->default(0);
            $table->string('status')->default('active');
            $table->timestamps();

            $table->index('dealer_id');
            $table->index('period');
            $table->index('year');
            $table->index('month');
            $table->index('status');
            $table->unique(['dealer_id', 'period', 'year', 'month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dealer_targets');
    }
};
