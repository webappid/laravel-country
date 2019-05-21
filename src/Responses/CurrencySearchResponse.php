<?php
/**
 * Author: galih
 * Date: 2019-05-21
 * Time: 04:41
 */

namespace WebAppId\Country\Responses;


use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\DDD\Responses\AbstractResponse;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class CurrencySearchResponse
 * @package WebAppId\Country\Responses
 */
class CurrencySearchResponse extends AbstractResponse
{
    /**
     * @var LengthAwarePaginator
     */
    private $currency;
    
    /**
     * @return LengthAwarePaginator
     */
    public function getCurrency(): LengthAwarePaginator
    {
        return $this->currency;
    }
    
    /**
     * @param LengthAwarePaginator $currency
     */
    public function setCurrency(LengthAwarePaginator $currency): void
    {
        $this->currency = $currency;
    }
    
    
}