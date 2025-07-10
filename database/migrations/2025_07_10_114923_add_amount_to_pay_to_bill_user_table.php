<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bill_user', function (Blueprint $table) {
            $table->decimal('amount_to_pay', 10, 2)->default(0)->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('bill_user', function (Blueprint $table) {
            $table->dropColumn('amount_to_pay');
        });
    }
};