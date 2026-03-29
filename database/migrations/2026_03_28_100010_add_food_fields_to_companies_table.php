<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->enum('price_range', ['€', '€€', '€€€', '€€€€'])->nullable()->after('category');
            $table->decimal('avg_rating', 3, 2)->default(0)->after('price_range');
            $table->unsignedInteger('review_count')->default(0)->after('avg_rating');
            $table->boolean('is_featured')->default(false)->after('review_count');
            $table->boolean('is_active')->default(true)->after('is_featured');
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['price_range', 'avg_rating', 'review_count', 'is_featured', 'is_active']);
        });
    }
};
