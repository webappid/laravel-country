<?php
/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 20:12
 */

namespace WebAppId\Country\Repositories\Contracts;


use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Country\Models\Country;
use WebAppId\Country\Services\Params\CountryParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Interface CountryRepositoryContract
 * @package WebAppId\Country\Repositories\Contracts
 */
interface CountryRepositoryContract
{
    /**
     * @param CountryParam $countryParam
     * @param Country $country
     * @return Country|null
     */
    public function store(CountryParam $countryParam, Country $country): ?Country;
    
    /**
     * @param string $code
     * @param Country $country
     * @return Country|null
     */
    public function getByCode(string $code,
                                     Country $country): ?Country;
    
    /**
     * @param CountryParam $countryParam
     * @param string $code
     * @param Country $country
     * @return Country|null
     */
    public function updateByCode(CountryParam $countryParam,
                                 string $code,
                                 Country $country): ?Country;
    
    /**
     * @param string $search
     * @param Country $country
     * @param int $paging
     * @return LengthAwarePaginator|null
     */
    public function getLike(string $search,
                                   Country $country,
                                   int $paging = 12): LengthAwarePaginator;
}