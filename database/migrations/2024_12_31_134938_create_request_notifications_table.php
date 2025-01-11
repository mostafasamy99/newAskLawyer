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
        Schema::create('request_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_request_id')->nullable(); 
            $table->unsignedBigInteger('sender_id'); 
            $table->string('sender_type'); 
            $table->unsignedBigInteger('receiver_id'); 
            $table->string('receiver_type'); 
            $table->string('title');
            $table->text('body');
            $table->boolean('is_read')->default(false); 
            $table->timestamps();

            $table->foreign('user_request_id')->references('id')->on('user_requests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_notifications');
    }
};
