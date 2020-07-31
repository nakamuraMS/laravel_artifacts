<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemindMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remind_mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('datetime')->nullable()->comment('送信日時');
            $table->binary('body')->nullable()->comment('メール本文');
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
        Schema::dropIfExists('remind_mails');
    }
}
