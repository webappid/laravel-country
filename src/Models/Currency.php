<?php
/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 18:41
 */

namespace WebAppId\Country\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class Currencies
 * @package WebAppId\Country\Models
 */

class Currency extends Model
{
    protected $table = 'currencies';
    
    protected $fillable = ['id', 'code', 'name'];
    
    protected $hidden = ['created_at', 'updated_at'];
}