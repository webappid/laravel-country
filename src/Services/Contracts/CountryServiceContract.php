<?php
/**
 * Author: galih
 * Date: 2019-05-21
 * Time: 04:39
 */

namespace WebAppId\Country\Services\Contracts;


use WebAppId\Country\Repositories\CountryRepository;
use WebAppId\Country\Responses\CountryResponse;
use WebAppId\Country\Responses\CountrySearchResponse;
use WebAppId\Country\Services\Params\CountryParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Interface CountryServiceContract
 * @package WebAppId\Country\Services\Contracts
 */
interface CountryServiceContract
{
    /**
     * @param CountryParam $countryParam
     * @param CountryRepository $countryRepository
     * @param CountryResponse $countryResponse
     * @return CountryResponse
     */
    public function store(CountryParam $countryParam,
                          CountryRepository $countryRepository,
                          CountryResponse $countryResponse): CountryResponse;
    
    /**
     * @param string $code
     * @param CountryRepository $countryRepository
     * @param CountryResponse $countryResponse
     * @return CountryResponse
     */
    public function getByCode(string $code,
                              CountryRepository $countryRepository,
                              CountryResponse $countryResponse): CountryResponse;
    
    /**
     * @param string $q
     * @param CountryRepository $countryRepository
     * @param CountrySearchResponse $countrySearchResponse
     * @return CountrySearchResponse|null
     */
    public function getLike(string $q,
                            CountryRepository $countryRepository,
                            CountrySearchResponse $countrySearchResponse): ?CountrySearchResponse;
    
    /**
     * @param string $code
     * @param CountryParam $countryParam
     * @param CountryRepository $countryRepository
     * @param CountryResponse $countryResponse
     * @return CountryResponse|null
     */
    public function updateCountry(string $code,
                                  CountryParam $countryParam,
                                  CountryRepository $countryRepository, CountryResponse $countryResponse): ?CountryResponse;
}