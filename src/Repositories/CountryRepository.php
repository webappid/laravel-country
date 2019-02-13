<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-12
 * Time: 14:44
 */

namespace WebAppId\Country\Repositories;

use Illuminate\Container\Container;
use Illuminate\Database\QueryException;
use WebAppId\Country\Models\Country;
use WebAppId\Country\Services\Params\AddCountryParam;

/**
 * Class CountryRepository
 * @package WebAppId\Country\Repositories
 */
class CountryRepository
{
    private $container;
    
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    
    /**
     * @param AddCountryParam $addCountryParam
     * @param Country $country
     * @return Country|null
     */
    public function addCountry(AddCountryParam $addCountryParam,
                               Country $country): ?Country
    {
        try {
            if ($addCountryParam->getId() != null) {
                $country->id = $addCountryParam->getId();
            }
            $country->code = $addCountryParam->getCode();
            $country->name = $addCountryParam->getName();
            $country->continent = $addCountryParam->getContinent();
            $country->wikipedia_link = $addCountryParam->getWikipediaLink();
            $country->keywords = $addCountryParam->getKeywords();
            $country->save();
            return $country;
        } catch (QueryException $queryException) {
            dd($queryException);
            report($queryException);
            return null;
        }
    }
    
    /**
     * @param string $search
     * @param Country $country
     * @param int $paging
     * @return object|null
     */
    public function getCountryLike(string $search,
                                   Country $country,
                                   int $paging = 12): ?object
    {
        return $country
            ->where('code', 'LIKE', '%' . $search . '%')
            ->orWhere('name', 'LIKE', '%' . $search . '%')
            ->paginate($paging);
    }
    
    /**
     * @param string $code
     * @param Country $country
     * @return object|null
     */
    public function getCountryByCode(string $code,
                                     Country $country): ?object
    {
        return $country->where('code', $code)->first();
    }
    
    /**
     * @param AddCountryParam $addCountryParam
     * @param string $code
     * @param Country $country
     * @return Country|null
     */
    public function updateCountryByCode(AddCountryParam $addCountryParam,
                                        string $code,
                                        Country $country): ?Country
    {
        $result = $this->getCountryByCode($code, $country);
        if ($result != null) {
            try {
                $result->code = $addCountryParam->getCode();
                $result->name = $addCountryParam->getName();
                $result->continent = $addCountryParam->getContinent();
                $result->wikipedia_link = $addCountryParam->getWikipediaLink();
                $result->keywords = $addCountryParam->getKeywords();
                $result->save();
                return $result;
            } catch (QueryException $queryException) {
                report($queryException);
                return null;
            }
        }
        return null;
    }
}