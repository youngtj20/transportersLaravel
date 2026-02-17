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
        Schema::create('movement_members', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('gender');
            $table->string('email')->nullable();
            $table->string('phone_number');
            $table->string('state_of_origin');
            $table->string('lga');
            $table->json('modes_of_transport');
            $table->boolean('approved')->default(false);
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movement_members');
    }
};
