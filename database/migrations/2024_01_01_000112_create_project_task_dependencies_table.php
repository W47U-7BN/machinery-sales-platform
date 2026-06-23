<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_task_dependencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('project_tasks')->cascadeOnDelete();
            $table->foreignId('dependency_task_id')->constrained('project_tasks')->cascadeOnDelete();
            $table->timestamp('created_at')->useCurrent();

            $table->index('task_id');
            $table->index('dependency_task_id');
            $table->unique(['task_id', 'dependency_task_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_task_dependencies');
    }
};
