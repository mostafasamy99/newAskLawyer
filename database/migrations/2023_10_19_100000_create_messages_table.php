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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('body', 30000)->nullable();
            $table->integer('room_id')->nullable();
            $table->integer('request_id')->nullable();
            $table->nullableMorphs('senderable');
            $table->nullableMorphs('receiverable');
            $table->dateTime('read_at')->nullable();
            $table->dateTime('receiver_deleted_at')->nullable();
            $table->dateTime('sender_deleted_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_activate')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
