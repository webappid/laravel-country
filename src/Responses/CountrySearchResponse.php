<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-13
 * Time: 16:25
 */

namespace WebAppId\Country\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\DDD\Responses\AbstractResponse;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class CountrySearchResponse
 * @package WebAppId\Country\Responses
 */
class CountrySearchResponse extends AbstractResponse
{
    /**
     * @var LengthAwarePaginator
     */
    private $country;
    
    /**
     * @return LengthAwarePaginator
     */
    public function getCountry():LengthAwarePaginator
    {
        return $this->country;
    }
    
    /**
     * @param LengthAwarePaginator $country
     */
    public function setCountry(LengthAwarePaginator $country): void
    {
        $this->country = $country;
    }
    
    
}