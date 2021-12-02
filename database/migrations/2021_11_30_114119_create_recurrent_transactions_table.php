<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecurrentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurrent_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->boolean('is_personal')->default(0)->comment("If the amount will be added to the whole home or just on the personal balance.");
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('amount');
            $table->integer('recurrence')->default(0)->comment("0 no recurrent, 1 monthly, 2 weekly, 3 specific date, 4 specific day");
            $table->string('recurrence_details')->nullable()->default('Detail of the recurrence of the event');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recurrent_transactions');
    }
}
