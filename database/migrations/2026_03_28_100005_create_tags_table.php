<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('color', 7)->default('#198754');
            $table->enum('type', ['dietary', 'feature', 'allergen'])->default('dietary');
            $table->timestamps();
        });

        Schema::create('menu_item_tag', function (Blueprint $table) {
            $table->foreignId('menu_item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['menu_item_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_item_tag');
        Schema::dropIfExists('tags');
    }
};
