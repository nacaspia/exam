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
        Schema::create('seos', function (Blueprint $table) {
            $table->id();

            // Polymorphic əlaqə
            $table->morphs('seoable');
            // seoable_id, seoable_type

            // Multilang SEO
            $table->json('meta_title')->nullable();
            $table->json('meta_slug')->nullable();
            $table->json('meta_text')->nullable();
            $table->json('meta_keywords')->nullable();

            // Extra SEO
            $table->string('canonical_url')->nullable();
            $table->boolean('index')->default(true);
            $table->boolean('follow')->default(true);

            // OG / Social
            $table->json('og_title')->nullable();
            $table->json('og_slug')->nullable();
            $table->json('og_text')->nullable();
            $table->string('og_image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seos');
    }
};
