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
        Schema::create('lawyer_accepted_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lawyer_id');
            $table->unsignedBigInteger('platform_service_id');
            $table->decimal('price', 10, 2)->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->foreign('lawyer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('platform_service_id')->references('id')->on('platform_services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lawyer_accepted_services');
    }
};
