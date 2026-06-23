<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_ticket_spareparts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_ticket_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained();
            $table->decimal('quantity', 15, 2)->default(1);
            $table->decimal('price', 15, 2)->default(0);
            $table->timestamp('created_at')->useCurrent();

            $table->index('service_ticket_id');
            $table->index('product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_ticket_spareparts');
    }
};
