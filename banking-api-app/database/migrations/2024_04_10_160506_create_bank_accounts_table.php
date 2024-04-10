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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id(); // Using UUID could be better in the long-term, keeping it simple for time's sake.
            $table->foreignId('user_id')->index();
            $table->string('account_number')->unique();
            $table->string('account_type'); // Current, Savings, etc...
            $table->string('iban')->unique();
            $table->decimal('balance', 10, 2)->default(0.00); // This can be changed into an integer of cents to avoid fraction issues.
            $table->decimal('blocked_amount', 10, 2)->default(0.00); // Amount that is blocked from the account due to pending transactions.
            $table->string('currency')->default('EUR');
            $table->string('state')->default('open');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('bank_accounts', function (Blueprint $table) {
        //     $table->dropSoftDeletes(); // Drop soft deletes
        // });
        Schema::dropIfExists('bank_accounts');
    }
};
