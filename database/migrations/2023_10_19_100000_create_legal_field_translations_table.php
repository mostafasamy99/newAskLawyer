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
        return true;
        Schema::create('legal_field_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('legal_field_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name', 255)->nullable();
        
            $table->unique(['legal_field_id', 'locale']);
            $table->foreign('legal_field_id')->references('id')->on('legal_fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legal_field_translations');
    }
};
