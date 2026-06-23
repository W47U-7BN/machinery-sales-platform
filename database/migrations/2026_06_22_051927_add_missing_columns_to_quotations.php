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
        Schema::table('quotations', function (Blueprint $table) {
            $table->string('title')->nullable()->after('sales_id');
            $table->decimal('discount_amount', 15, 2)->default(0)->after('discount_value');
            $table->decimal('total_amount', 15, 2)->default(0)->after('total');
            $table->timestamp('rejected_at')->nullable()->after('approved_at');
            $table->text('rejection_reason')->nullable()->after('rejected_at');
        });
    }

    public function down(): void
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropColumn(['title', 'discount_amount', 'total_amount', 'rejected_at', 'rejection_reason']);
        });
    }
};
