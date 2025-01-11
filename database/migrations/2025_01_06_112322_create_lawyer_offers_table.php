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
        Schema::create('lawyer_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('request_id'); 
            $table->unsignedBigInteger('lawyer_id'); 
            $table->decimal('price', 10, 2)->nullable();  
            $table->text('message')->nullable(); 
            $table->boolean('is_rejected')->default(false);  
            $table->unsignedBigInteger('accepted_by')->nullable(); 
            $table->timestamps();

            $table->foreign('request_id')->references('id')->on('requests')->onDelete('cascade');
            $table->foreign('lawyer_id')->references('id')->on('lawyers')->onDelete('cascade');
            $table->foreign('accepted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lawyer_offers');
    }
};
