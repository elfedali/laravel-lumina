<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('locales', function (Blueprint $table) {
            $table->string('website')->nullable()->after('email');
            $table->string('instagram')->nullable()->after('website');
            $table->string('facebook')->nullable()->after('instagram');
            $table->decimal('avg_rating', 3, 2)->default(0)->after('facebook');
            $table->unsignedInteger('review_count')->default(0)->after('avg_rating');
            $table->unsignedSmallInteger('capacity')->nullable()->after('review_count');
        });
    }

    public function down(): void
    {
        Schema::table('locales', function (Blueprint $table) {
            $table->dropColumn(['website', 'instagram', 'facebook', 'avg_rating', 'review_count', 'capacity']);
        });
    }
};
