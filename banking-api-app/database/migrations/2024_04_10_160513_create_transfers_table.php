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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id(); // Using UUID could be better in the long-term, keeping it simple for time's sake.
            $table->foreignId('user_id')->index(); // Better for reporting but can be omitted.
            $table->foreignId('from_bank_account_id')->index(); // Tranfer from
            $table->foreignId('to_bank_account_id')->index(); // Transfer to
            $table->decimal('transfer_amount', 10, 2);
            $table->string('state')->default('pending'); // Using Spatie's state management package would be better, keeping it simple for time's sake.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
