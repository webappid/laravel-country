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
use WebAppId\Country\Services\Params\CountryParam;

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
     * @param CountryParam $countryParam
     * @param CountryRepository $countryRepository
     * @return Country|null
     */
    public function store(CountryParam $countryParam,
                          CountryRepository $countryRepository): ?Country
    {
        return $this->container->call([$countryRepository, 'store'], ['countryParam' => $countryParam]);
    }
    
    /**
     * @param string $code
     * @param CountryRepository $countryRepository
     * @return object|null
     */
    public function getByCode(string $code,
                                     CountryRepository $countryRepository): ?object
    {
        return $this->container->call([$countryRepository, 'getByCode'], ['code' => $code]);
    }
    
    /**
     * @param string $q
     * @param CountryRepository $countryRepository
     * @param CountrySearchResponse $countrySearchResponse
     * @return object|null
     */
    public function getLike(string $q,
                                   CountryRepository $countryRepository,
                                   CountrySearchResponse $countrySearchResponse): ?CountrySearchResponse
    {
        $result = $this->container->call([$countryRepository, 'getLike'], ['search' => $q]);
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
     * @param CountryParam $countryParam
     * @param CountryRepository $countryRepository
     * @return Country|null
     */
    public function updateCountry(string $code,
                                  CountryParam $countryParam,
                                  CountryRepository $countryRepository): ?Country
    {
        return $this->container->call([$countryRepository, 'updateByCode'], ['addCountryParam' => $countryParam, 'code' => $code]);
    }
}