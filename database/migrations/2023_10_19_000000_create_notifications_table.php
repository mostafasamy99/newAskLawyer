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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('content', 2550)->nullable();
            $table->tinyInteger('type')->default(0)->comment('0 => target user, 1 => for lawyers, 2 => for users, 3 => for all');
            $table->tinyInteger('is_read')->default(0);
            $table->nullableMorphs('userable');
            $table->nullableMorphs('targetable');
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
        Schema::dropIfExists('notifications');
    }
};
