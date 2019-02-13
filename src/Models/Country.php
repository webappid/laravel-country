<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-12
 * Time: 13:57
 */

namespace WebAppId\Country\Models;

use \Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    
    protected $fillable = ['id','code', 'name', 'continent', 'wikipedia_link', 'keywords'];
}