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
        Schema::create('lawyers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('mobile', 50)->nullable();
            $table->string('img', 555)->nullable();
            $table->string('union_card', 555)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('linked_in', 255)->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('lang_id')->nullable();
            $table->string('lang',10)->nullable();
            $table->string('address', 9000)->nullable();
            $table->text('file', 20000)->nullable();
            $table->string('token', 255)->nullable();
            $table->string('code', 55)->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->string('password', 255)->nullable();
            $table->string('memberships', 1255)->nullable();
            $table->string('disclaimer', 1255)->nullable();
            $table->tinyInteger('type')->default(0)->comment('1 -> lawyer , 2 -> company, 3 => advisor');
            $table->tinyInteger('is_activate')->default(1);
            $table->tinyInteger('report_id')->default(1);
            $table->text('website_company')->nullable();
            $table->text('linked_in_company')->nullable();
            $table->text('address_company')->nullable();
            $table->text('city_id_company')->nullable();
            $table->text('country_id_company')->nullable();
            $table->text('office_rent')->nullable();
            $table->text('passport')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lawyers');
    }
};
