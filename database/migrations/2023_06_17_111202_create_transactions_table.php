<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{

    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {

            $table->id()->unique();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->bigInteger('transfer_amount')->nullable();
            $table->bigInteger('converted_amount')->nullable();
            $table->string('type');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
