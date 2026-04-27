<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::table('fees', function (Blueprint $table) {
        $table->string('razorpay_payment_id')->nullable();
        $table->string('razorpay_order_id')->nullable();
        $table->string('razorpay_signature')->nullable();
        $table->string('status')->default('pending'); // success, failed
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fees', function (Blueprint $table) {
            //
        });
    }
};
