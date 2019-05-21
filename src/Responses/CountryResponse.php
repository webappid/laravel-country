<?php
/**
 * Author: galih
 * Date: 2019-05-21
 * Time: 04:30
 */

namespace WebAppId\Country\Responses;


use WebAppId\Country\Models\Country;
use WebAppId\DDD\Responses\AbstractResponse;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class CountryResponse
 * @package WebAppId\Country\Responses
 */
class CountryResponse extends AbstractResponse
{
    /**
     * @var Country
     */
    private $country;
    
    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }
    
    /**
     * @param Country $country
     */
    public function setCountry(Country $country): void
    {
        $this->country = $country;
    }
    
}