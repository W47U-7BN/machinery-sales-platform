<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_receivings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained()->cascadeOnDelete();
            $table->string('receiving_number')->unique();
            $table->date('received_date');
            $table->string('status')->default('pending');
            $table->text('notes')->nullable();
            $table->foreignId('received_by')->constrained('users');
            $table->timestamps();

            $table->index('purchase_order_id');
            $table->index('status');
            $table->index('received_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_receivings');
    }
};
