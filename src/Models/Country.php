<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-12
 * Time: 13:57
 */

namespace WebAppId\Country\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class Country
 * @package WebAppId\Country\Models
 */
class Country extends Model
{
    protected $table = 'countries';
    
    protected $fillable = ['id', 'code', 'name', 'currency_id', 'continent', 'wikipedia_link', 'keywords'];
    
    protected $hidden = ['updated_at', 'created_at'];
    
    /**
     * @return BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
    
}