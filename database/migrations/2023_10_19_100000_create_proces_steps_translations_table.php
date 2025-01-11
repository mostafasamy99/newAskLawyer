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
        Schema::create('proces_step_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('proces_step_id')->unsigned();
            $table->string('locale')->index();
            $table->text('content', 20000)->nullable();
        
            $table->unique(['proces_step_id', 'locale']);
            $table->foreign('proces_step_id')->references('id')->on('proces_steps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proces_step_translations');
    }
};
