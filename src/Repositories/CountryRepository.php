<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-12
 * Time: 14:44
 */

namespace WebAppId\Country\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Country\Models\Country;
use WebAppId\Country\Repositories\Contracts\CountryRepositoryContract;
use WebAppId\Country\Services\Params\CountryParam;

/**
 * Class CountryRepository
 * @package WebAppId\Country\Repositories
 */
class CountryRepository implements CountryRepositoryContract
{
    
    /**
     * @param CountryParam $countryParam
     * @param Country $country
     * @return Country|null
     */
    public function store(CountryParam $countryParam,
                          Country $country): ?Country
    {
        try {
            if ($countryParam->getId() != null) {
                $country->id = $countryParam->getId();
            }
            $country->code = $countryParam->getCode();
            $country->name = $countryParam->getName();
            $country->currency_id = $countryParam->getCurrencyId();
            $country->continent = $countryParam->getContinent();
            $country->wikipedia_link = $countryParam->getWikipediaLink();
            $country->keywords = $countryParam->getKeywords();
            $country->save();
            return $country;
        } catch (QueryException $queryException) {
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
    public function getLike(string $search,
                                   Country $country,
                                   int $paging = 12): LengthAwarePaginator
    {
        return $country
            ->where('code', 'LIKE', '%' . $search . '%')
            ->orWhere('name', 'LIKE', '%' . $search . '%')
            ->paginate($paging);
    }
    
    /**
     * @param string $code
     * @param Country $country
     * @return Country|null
     */
    public function getByCode(string $code,
                                     Country $country): ?Country
    {
        return $country->where('code', $code)->first();
    }
    
    /**
     * @param CountryParam $countryParam
     * @param string $code
     * @param Country $country
     * @return Country|null
     */
    public function updateByCode(CountryParam $countryParam,
                                 string $code,
                                 Country $country): ?Country
    {
        $result = $this->getByCode($code, $country);
        if ($result != null) {
            try {
                $result->code = $countryParam->getCode();
                $result->name = $countryParam->getName();
                $result->currency_id = $countryParam->getCurrencyId();
                $result->continent = $countryParam->getContinent();
                $result->wikipedia_link = $countryParam->getWikipediaLink();
                $result->keywords = $countryParam->getKeywords();
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