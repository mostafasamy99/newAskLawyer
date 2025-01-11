<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // $table->string('title', 255)->nullable();
            // $table->text('content', 20000)->nullable();
            // $table->string('description', 1200)->nullable();
            $table->string('img', 255)->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('service_id')->nullable();
            $table->integer('section_id')->nullable();
            $table->integer('added_by_id')->nullable();
            $table->tinyInteger('added_by_type')->comment('1 => admin , 2 => lawyer')->nullable();
            $table->integer('price')->default(0);
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_activate')->default(1);
            $table->tinyInteger('is_favorite')->default(0);
            $table->tinyInteger('is_fixed_service')->default(0);
            $table->tinyInteger('is_publish')->default(1);
            $table->tinyInteger('report_id')->default(1);
            $table->tinyInteger('order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
