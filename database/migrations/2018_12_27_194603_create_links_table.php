<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('link_id');
            $table->string('link_name')->default('')->comment('//链接名称');
            $table->string('link_intro')->default('')->comment('//介绍');
            $table->string('link_url')->default('')->comment('//地址');
            $table->integer('link_order')->default(0)->comment('//排序');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('links');
    }
}
