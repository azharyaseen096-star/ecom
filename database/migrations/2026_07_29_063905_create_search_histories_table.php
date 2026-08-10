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
        Schema::create('search_histories', function (Blueprint $table) {

            $table->id();

            // User ne kya search kiya
            $table->string('keyword');

            // wikipedia | website | linkedin | github ...
            $table->string('type');

            // Original URL (agar website search ho)
            $table->text('url')->nullable();

            // Page title
            $table->string('title')->nullable();

            // Success / Failed
            $table->boolean('success')->default(true);

            // Error message
            $table->text('error')->nullable();

            // Search duration (milliseconds)
            $table->integer('duration')->nullable();

            // User IP
            $table->string('ip_address')->nullable();

            // Browser
            $table->text('user_agent')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_histories');
    }
};