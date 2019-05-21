<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-13
 * Time: 13:05
 */

namespace WebAppId\Country\Services;


use WebAppId\Country\Models\Country;
use WebAppId\Country\Repositories\CountryRepository;
use WebAppId\Country\Responses\CountryResponse;
use WebAppId\Country\Responses\CountrySearchResponse;
use WebAppId\Country\Services\Params\CountryParam;
use WebAppId\DDD\Services\BaseService;

/**
 * Class CountryService
 * @package WebAppId\Country\Services
 */
class CountryService extends BaseService
{
    /**
     * @param CountryParam $countryParam
     * @param CountryRepository $countryRepository
     * @param CountryResponse $countryResponse
     * @return CountryResponse
     */
    public function store(CountryParam $countryParam,
                          CountryRepository $countryRepository,
                          CountryResponse $countryResponse): CountryResponse
    {
        $result =  $this->getContainer()->call([$countryRepository, 'store'], ['countryParam' => $countryParam]);
        if ($result != null) {
            $countryResponse->setStatus(true);
            $countryResponse->setMessage('Update Country Success');
            $countryResponse->setCountry($result);
        } else {
            $countryResponse->setStatus(false);
            $countryResponse->setMessage('Update Country Failed');
        }
        return $countryResponse;
    }
    
    /**
     * @param string $code
     * @param CountryRepository $countryRepository
     * @param CountryResponse $countryResponse
     * @return CountryResponse
     */
    public function getByCode(string $code,
                              CountryRepository $countryRepository,
                              CountryResponse $countryResponse): CountryResponse
    {
        $result =  $this->getContainer()->call([$countryRepository, 'getByCode'], ['code' => $code]);
        if ($result != null) {
            $countryResponse->setStatus(true);
            $countryResponse->setMessage('Update Country Success');
            $countryResponse->setCountry($result);
        } else {
            $countryResponse->setStatus(false);
            $countryResponse->setMessage('Update Country Failed');
        }
        return $countryResponse;
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
        $result = $this->getContainer()->call([$countryRepository, 'getLike'], ['search' => $q]);
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
     * @param CountryResponse $countryResponse
     * @return Country|null
     */
    public function updateCountry(string $code,
                                  CountryParam $countryParam,
                                  CountryRepository $countryRepository, CountryResponse $countryResponse): ?CountryResponse
    {
        $result = $this->getContainer()->call([$countryRepository, 'updateByCode'], ['countryParam' => $countryParam, 'code' => $code]);
        if ($result != null) {
            $countryResponse->setStatus(true);
            $countryResponse->setMessage('Update Country Success');
            $countryResponse->setCountry($result);
        } else {
            $countryResponse->setStatus(false);
            $countryResponse->setMessage('Update Country Failed');
        }
        return $countryResponse;
    }
}