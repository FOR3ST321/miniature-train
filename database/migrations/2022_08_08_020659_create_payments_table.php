<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('payment_type', ['avatar', 'incognito']);
            $table->integer('amount');
            $table->unsignedBigInteger('avatar_id')->nullable();
            $table->boolean('is_a_gift')->nullable();
            $table->enum('payment_method', ['Credit Card', 'PayPal']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('avatar_id')->references('id')->on('avatars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
