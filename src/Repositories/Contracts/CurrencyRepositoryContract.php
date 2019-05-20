<?php
/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 20:33
 */

namespace WebAppId\Country\Repositories\Contracts;


use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\Country\Models\Currency;
use WebAppId\Country\Services\Params\CurrencyParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Interface CurrencyRepositoryContract
 * @package WebAppId\Country\Repositories\Contracts
 */
interface CurrencyRepositoryContract
{
    /**
     * @param CurrencyParam $currencyParam
     * @param Currency $currency
     * @return Currency|null
     */
    public function store(CurrencyParam $currencyParam, Currency $currency): ?Currency;
    
    /**
     * @param CurrencyParam $currencyParam
     * @param Currency $currency
     * @return Currency|null
     */
    public function update(CurrencyParam $currencyParam, Currency $currency): ?Currency;
    
    /**
     * @param string $code
     * @param Currency $currency
     * @return Currency|null
     */
    public function getByCode(string $code, Currency $currency): ?Currency;
    
    /**
     * @param string $q
     * @param Currency $currency
     * @param int $paging
     * @return LengthAwarePaginator
     */
    public function getLike(string $q, Currency $currency, int $paging = 12): LengthAwarePaginator;
}