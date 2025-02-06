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

            $table->string('name')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();

            $table->string('address');
            $table->string('city');
            $table->string('neighborhood');
            $table->string('country');
            $table->string('zip')->nullable();

            $table->string('phone');
            $table->string('phone2')->nullable();


            $table->string('email')->nullable();
            $table->json('media')->nullable();

            $table->string('cover')->nullable();

            $table->boolean('is_primary')->default(false);

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
