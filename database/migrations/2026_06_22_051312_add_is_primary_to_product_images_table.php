<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            if (!Schema::hasColumn('product_images', 'is_primary')) {
                $table->boolean('is_primary')->default(false)->after('sort_order');
            }
            if (!Schema::hasColumn('product_images', 'image_path')) {
                $table->string('image_path')->nullable()->after('image');
            }
            if (!Schema::hasColumn('product_images', 'alt_text')) {
                $table->string('alt_text')->nullable()->after('image_path');
            }
        });

        DB::statement('ALTER TABLE product_images MODIFY image VARCHAR(255) NULL');
    }

    public function down(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropColumn(['is_primary', 'image_path', 'alt_text']);
        });
    }
};
