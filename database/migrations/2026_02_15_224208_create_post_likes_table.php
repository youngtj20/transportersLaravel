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
        Schema::create('post_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('ip_address')->nullable();
            $table->enum('type', ['like', 'dislike'])->default('like');
            $table->timestamps();
            
            $table->unique(['post_id', 'user_id', 'ip_address'], 'unique_post_user_ip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_likes');
    }
};
