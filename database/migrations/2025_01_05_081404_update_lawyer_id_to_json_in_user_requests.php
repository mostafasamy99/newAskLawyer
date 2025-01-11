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
        Schema::table('user_requests', function (Blueprint $table) {
            $table->dropForeign('user_requests_lawyer_id_foreign');
    
            $table->dropColumn('lawyer_id');
        });
    
        Schema::table('user_requests', function (Blueprint $table) {
            $table->json('lawyer_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('lawyer_id')->nullable()->change();
        });
    }
};
