<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('selling_price', 15, 2)->nullable()->after('price');
            $table->decimal('discount_price', 15, 2)->nullable()->after('selling_price');
            $table->integer('minimum_stock')->default(0)->after('selling_price');
            $table->integer('maximum_stock')->nullable()->after('minimum_stock');
            $table->json('specifications')->nullable()->after('discount_price');
            $table->text('meta_keywords')->nullable()->after('meta_description');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['selling_price', 'discount_price', 'minimum_stock', 'maximum_stock', 'specifications', 'meta_keywords']);
        });
    }
};
