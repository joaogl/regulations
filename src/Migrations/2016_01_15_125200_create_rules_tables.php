<?php

use jlourenco\base\Database\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRulesTables extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('Rule', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->text('rule');
            $table->binary('status');

            $table->timestamps();
            $table->softDeletes();
            $table->creation();
        });

        Schema::create('RuleTree', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->nullable();
            $table->integer('rule')->unsigned()->nullable();
            $table->integer('parent')->unsigned()->nullable();
            $table->string('list', 100);

            $table->timestamps();
            $table->softDeletes();
            $table->creation();

            $table->foreign('rule')->references('id')->on('Rule');
            $table->foreign('parent')->references('id')->on('RuleTree');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('RuleTree');
        Schema::drop('Rule');

    }

}
