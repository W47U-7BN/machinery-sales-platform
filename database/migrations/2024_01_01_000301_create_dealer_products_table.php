<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dealer_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dealer_id')->constrained('dealer_information')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->decimal('dealer_price', 15, 2)->default(0);
            $table->integer('min_quantity')->default(1);
            $table->timestamps();

            $table->index('dealer_id');
            $table->index('product_id');
            $table->unique(['dealer_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dealer_products');
    }
};
