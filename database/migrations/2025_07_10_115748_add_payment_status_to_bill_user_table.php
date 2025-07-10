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
        Schema::table('bill_user', function (Blueprint $table) {
            $table->enum('payment_status', ['Pending', 'Paid'])->default('Pending')->after('amount_to_pay');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bill_user', function (Blueprint $table) {
            $table->dropColumn('payment_status');
        });
    }
};