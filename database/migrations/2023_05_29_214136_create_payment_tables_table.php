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
        Schema::create('payment_tables', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            // $table->string('user_email');
            $table->double('amount',10,2);
            // $table->bigInteger('card_no');
            // $table->string('date');
            // $table->bigInteger('cvc');
            $table->integer('transaction_id');
            $table->tinyInteger('status')->default(0)->comment('0-paid, 1-pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_tables');
    }
};
