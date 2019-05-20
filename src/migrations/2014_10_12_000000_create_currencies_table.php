<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 18:21
 */

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table){
            $table->increments('id');
            $table->string('code', 5)
                ->unique()
                ->index()
                ->comment('currency code');
            $table->string('name', 100)
                ->comment('currency name');
            $table->timestamps();
        });
    }
    
    /**
     * Run the migrations
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('currencies');
    }
}