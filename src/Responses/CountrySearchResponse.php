<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-13
 * Time: 16:25
 */

namespace WebAppId\Country\Responses;

use WebAppId\DDD\Responses\AbstractResponse;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class CountrySearchResponse
 * @package WebAppId\Country\Responses
 */
class CountrySearchResponse extends AbstractResponse
{
    private $country;
    
    /**
     * @return object
     */
    public function getCountry():object
    {
        return $this->country;
    }
    
    /**
     * @param object $country
     */
    public function setCountry(object $country): void
    {
        $this->country = $country;
    }
    
    
}