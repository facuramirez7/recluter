<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->string('position', 50);
            $table->string('description', 1500)->nullable();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->unsignedBigInteger('company_id')->unsigned();
            $table->smallInteger('time_to_think');
            $table->smallInteger('time_to_reply');
            $table->string('goodbye', 100);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interviews');
    }
};
