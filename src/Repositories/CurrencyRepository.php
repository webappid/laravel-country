<?php
/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 20:11
 */

namespace WebAppId\Country\Repositories;


use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Country\Models\Currency;
use WebAppId\Country\Repositories\Contracts\CurrencyRepositoryContract;
use WebAppId\Country\Services\Params\CurrencyParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class CurrencyRepository
 * @package WebAppId\Country\Repositories
 */
class CurrencyRepository implements CurrencyRepositoryContract
{
    
    /**
     * @param CurrencyParam $currencyParam
     * @param Currency $currency
     * @return Currency|null
     */
    public function store(CurrencyParam $currencyParam, Currency $currency): ?Currency
    {
        try {
            if ($currencyParam->getId() != null) {
                $currency->id = $currencyParam->getId();
            }
            
            $currency->code = $currencyParam->getCode();
            $currency->name = $currencyParam->getName();
            $currency->save();
            return $currency;
        } catch (QueryException $queryException) {
            report($queryException);
            return null;
        }
    }
    
    /**
     * @param CurrencyParam $currencyParam
     * @param Currency $currency
     * @return Currency|null
     */
    public function update(CurrencyParam $currencyParam, Currency $currency): ?Currency
    {
        $currency = $this->getByCode($currencyParam->getCode(), $currency);
        if ($currency != null) {
            try {
                $currency->name = $currencyParam->getName();
                $currency->save();
            } catch (QueryException $queryException) {
                report($queryException);
                return null;
            }
        }
        return $currency;
    }
    
    /**
     * @param string $code
     * @param Currency $currency
     * @return Currency|null
     */
    public function getByCode(string $code, Currency $currency): ?Currency
    {
        return $currency->where('code', $code)->first();
    }
    
    /**
     * @param string $q
     * @param Currency $currency
     * @param int $paging
     * @return LengthAwarePaginator
     */
    public function getLike(string $q, Currency $currency, int $paging = 12): LengthAwarePaginator
    {
        return $currency
            ->where('code', 'LIKE', '%'.$q.'%')
            ->orWhere('name', 'LIKE' , '%'.$q.'%')
            ->paginate($paging);
    }
}