<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_ticket_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_ticket_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->text('description');
            $table->foreignId('performed_by')->constrained('users');
            $table->timestamp('created_at')->useCurrent();

            $table->index('service_ticket_id');
            $table->index('performed_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_ticket_activities');
    }
};
