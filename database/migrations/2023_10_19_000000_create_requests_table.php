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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('username', 255)->nullable();
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('files', 1255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('mobile', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->text('message', 20000)->nullable();
            $table->integer('service_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('lawyer_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('blog_id')->nullable();
            $table->string('fixed_service_price', 55)->nullable();
            $table->tinyInteger('status')->default(0)->comment('1 => confirm, 2 => rejectd');
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_activate')->default(1);
            $table->tinyInteger('report_id')->default(1);
            $table->tinyInteger('is_read')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
};
