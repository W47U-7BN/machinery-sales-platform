<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendor_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('vendor_information')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->decimal('vendor_price', 15, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->boolean('is_available')->default(true);
            $table->timestamps();

            $table->index('vendor_id');
            $table->index('product_id');
            $table->unique(['vendor_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_products');
    }
};
