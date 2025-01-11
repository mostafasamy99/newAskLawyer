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
        Schema::create('platform_service_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('platform_services_id');
            $table->string('locale', 5);
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('platform_services_id')
                ->references('id')
                ->on('platform_services')
                ->onDelete('cascade');

            $table->unique(['platform_services_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platform_service_translations');
    }
};
