<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-13
 * Time: 13:05
 */

namespace WebAppId\Country\Services;


use Illuminate\Container\Container;
use WebAppId\Country\Models\Country;
use WebAppId\Country\Repositories\CountryRepository;
use WebAppId\Country\Responses\CountrySearchResponse;
use WebAppId\Country\Services\Params\AddCountryParam;

/**
 * Class CountryService
 * @package WebAppId\Country\Services
 */
class CountryService
{
    private $container;
    
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    
    /**
     * @param AddCountryParam $addCountryParam
     * @param CountryRepository $countryRepository
     * @return Country|null
     */
    public function addCountry(AddCountryParam $addCountryParam,
                               CountryRepository $countryRepository): ?Country
    {
        return $this->container->call([$countryRepository, 'addCountry'], ['addCountryParam' => $addCountryParam]);
    }
    
    /**
     * @param string $code
     * @param CountryRepository $countryRepository
     * @return object|null
     */
    public function getCountryByCode(string $code,
                                     CountryRepository $countryRepository): ?object
    {
        return $this->container->call([$countryRepository, 'getCountryByCode'], ['code' => $code]);
    }
    
    /**
     * @param string $q
     * @param CountryRepository $countryRepository
     * @param CountrySearchResponse $countrySearchResponse
     * @return object|null
     */
    public function getCountryLike(string $q,
                                   CountryRepository $countryRepository,
                                   CountrySearchResponse $countrySearchResponse): ?CountrySearchResponse
    {
        $result = $this->container->call([$countryRepository, 'getCountryLike'], ['search' => $q]);
        if (count($result) == 0) {
            $countrySearchResponse->setStatus(false);
            $countrySearchResponse->setMessage('Data Not Found');
        } else {
            $countrySearchResponse->setStatus(true);
            $countrySearchResponse->setMessage('Data Found');
            $countrySearchResponse->setCountry($result);
        }
        return $countrySearchResponse;
    }
    
    /**
     * @param string $code
     * @param AddCountryParam $addCountryParam
     * @param CountryRepository $countryRepository
     * @return Country|null
     */
    public function updateCountry(string $code,
                                  AddCountryParam $addCountryParam,
                                  CountryRepository $countryRepository): ?Country
    {
        return $this->container->call([$countryRepository, 'updateCountryByCode'], ['addCountryParam' => $addCountryParam, 'code' => $code]);
    }
}