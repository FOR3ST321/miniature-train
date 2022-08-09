<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('gender',['Male', 'Female']);
            $table->integer('age');
            $table->integer('coin');
            $table->string('instagram_link')->nullable();
            $table->string('phone');
            $table->longText('address');
            $table->unsignedBigInteger('avatar_id');
            $table->boolean('has_pay');
            $table->integer('regist_price');
            $table->boolean('is_incognito');
            $table->string('incognito_bear')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('users');
    }
}
