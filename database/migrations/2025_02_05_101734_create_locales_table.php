<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('locales', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100)->nullable();
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();

            $table->string('address', 100);
            $table->string('city', 60);
            $table->string('neighborhood', 100);
            $table->string('country')->default('Maroc');
            $table->string('zip')->nullable();

            $table->string('phone', 50);
            $table->string('phone2', 50)->nullable();


            $table->string('email', 50)->nullable();
            $table->json('media')->nullable();

            $table->string('cover')->nullable();

            $table->boolean('is_primary')->default(false);
            // open hours
            $table->json('hours')->nullable();
            $table->foreignId('company_id')->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locales');
    }
};
