<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('company_name')->nullable()->after('name');
            $table->string('customer_type')->nullable()->after('company_name');
            $table->string('state')->nullable()->after('city');
            $table->timestamp('registered_at')->nullable()->after('is_active');
            $table->string('tax_id')->nullable()->after('npwp');
            $table->string('alternative_phone')->nullable()->after('phone');
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->string('priority')->default('medium')->after('status');
            $table->string('title')->nullable()->after('customer_id');
            $table->decimal('estimated_value', 15, 2)->nullable()->after('budget');
            $table->date('expected_close_date')->nullable()->after('estimated_value');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('discount_amount', 15, 2)->default(0)->after('discount_value');
            $table->decimal('total_amount', 15, 2)->default(0)->after('total');
            $table->string('order_status')->nullable()->after('status');
            $table->string('payment_method')->nullable();
            $table->text('billing_address')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['company_name', 'customer_type', 'state', 'registered_at', 'tax_id', 'alternative_phone']);
        });

        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['priority', 'title', 'estimated_value', 'expected_close_date']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['discount_amount', 'total_amount', 'order_status', 'payment_method', 'billing_address', 'shipped_at', 'delivered_at']);
        });
    }
};
