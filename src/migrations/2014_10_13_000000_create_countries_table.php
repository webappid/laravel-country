<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-12
 * Time: 13:42
 */

use \Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class CreateCountriesTable
 */
class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 100)
                ->unique();
            $table->string('name', 100);
            $table->unsignedInteger('currency_id')
                ->comment('relation to currencies table');
            $table->string('continent', 100)
                ->nullable(true);
            $table->string('wikipedia_link', 150);
            $table->string('keywords', 100);
            $table->timestamps();
            
            /**
             * relation
             */
            
            $table->foreign('currency_id')->references('id')->on('currencies');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}