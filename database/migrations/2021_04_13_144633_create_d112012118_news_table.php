<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateD112012119NewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d112012118_news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('img_url');
            $table->text('sub_desc');
            $table->longtext('desc');
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
        Schema::dropIfExists('d112012118_news');
    }
}
