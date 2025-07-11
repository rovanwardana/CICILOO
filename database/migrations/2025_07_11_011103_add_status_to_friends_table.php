<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('friends', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('friend_id');
        });
    }

    public function down()
    {
        Schema::table('friends', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
