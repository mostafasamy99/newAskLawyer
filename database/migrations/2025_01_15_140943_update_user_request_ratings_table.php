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
        Schema::table('user_request_ratings', function (Blueprint $table) {
            $table->dropForeign(['user_request_id']);

            $table->renameColumn('user_request_id', 'request_id');
        });

        Schema::table('user_request_ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('request_id')->change();

            $table->string('request_model')->after('request_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
