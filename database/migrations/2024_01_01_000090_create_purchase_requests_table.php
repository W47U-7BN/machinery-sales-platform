<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->string('pr_number')->unique();
            $table->foreignId('requested_by')->constrained('users');
            $table->string('department')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('draft');
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->index('requested_by');
            $table->index('status');
            $table->index('approved_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_requests');
    }
};
