<?php
/**
 * Author: galih
 * Date: 2019-05-21
 * Time: 04:42
 */

namespace WebAppId\Country\Responses;

use WebAppId\Country\Models\Currency;
use WebAppId\DDD\Responses\AbstractResponse;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class CurrencyResponse
 * @package WebAppId\Country\Responses
 */
class CurrencyResponse extends AbstractResponse
{
    /**
     * @var Currency
     */
    private $currency;
    
    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }
    
    /**
     * @param Currency $currency
     */
    public function setCurrency(Currency $currency): void
    {
        $this->currency = $currency;
    }
}