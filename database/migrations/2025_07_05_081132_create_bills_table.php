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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->date('due_date')->nullable(); // Diubah menjadi nullable
            $table->string('bill_type');
            $table->string('bill_number')->unique();
            $table->foreignId('customer_id')->constrained('users')->onDelete('restrict'); // Diubah ke restrict
            $table->enum('split_method', ['equal', 'custom'])->default('equal'); // Ditentukan nilai enum
            $table->text('notes')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};