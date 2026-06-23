<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('source')->nullable();
            $table->string('status')->default('new');
            $table->decimal('budget', 15, 2)->nullable();
            $table->text('notes')->nullable();
            $table->string('interested_product')->nullable();
            $table->timestamp('converted_at')->nullable();
            $table->foreignId('converted_to_customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->timestamps();

            $table->index('customer_id');
            $table->index('product_id');
            $table->index('assigned_to');
            $table->index('status');
            $table->index('source');
            $table->index('converted_to_customer_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
