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
        Schema::create('cms_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cms_user_id');
            $table->foreign('cms_user_id')->references('id')->on('cms_users')->onDelete('cascade');
            $table->unsignedBigInteger('obj_id');
            $table->string('obj_table');
            $table->string('action');
            $table->longText('description');
            $table->string('ip');
            $table->timestamp('datetime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_logs');
    }
};
