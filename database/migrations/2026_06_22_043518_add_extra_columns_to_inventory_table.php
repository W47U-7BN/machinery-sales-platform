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
        Schema::table('inventory', function (Blueprint $table) {
            $table->decimal('minimum_quantity', 15, 2)->default(0)->after('quantity');
            $table->decimal('maximum_quantity', 15, 2)->nullable()->after('minimum_quantity');
            $table->decimal('reorder_point', 15, 2)->default(0)->after('max_quantity');
            $table->decimal('unit_cost', 15, 2)->nullable()->after('reorder_point');
            $table->string('batch_number')->nullable()->after('unit_cost');
            $table->date('expiry_date')->nullable()->after('batch_number');
            $table->boolean('is_active')->default(true)->after('expiry_date');
        });
    }

    public function down(): void
    {
        Schema::table('inventory', function (Blueprint $table) {
            $table->dropColumn(['minimum_quantity', 'maximum_quantity', 'reorder_point', 'unit_cost', 'batch_number', 'expiry_date', 'is_active']);
        });
    }
};
