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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('img', 255)->nullable();
            $table->tinyInteger('img_dir')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('about_type')->default(0)->comment('
                0->about page,1->about home page,2->ask lawyer home page,3->why us about page,4->user process,
                5->privacy policy
            ');
            $table->tinyInteger('is_activate')->default(1);
            $table->tinyInteger('report_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abouts');
    }
};
