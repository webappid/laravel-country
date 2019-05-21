<?php
/**
 * Author: galih
 * Date: 2019-05-21
 * Time: 04:43
 */

namespace WebAppId\Country\Services\Contracts;


use WebAppId\Country\Repositories\CurrencyRepository;
use WebAppId\Country\Responses\CurrencyResponse;
use WebAppId\Country\Responses\CurrencySearchResponse;
use WebAppId\Country\Services\Params\CurrencyParam;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Interface CurrencyServiceContract
 * @package WebAppId\Country\Services\Contracts
 */
interface CurrencyServiceContract
{
    /**
     * @param CurrencyParam $currencyParam
     * @param CurrencyRepository $currencyRepository
     * @param CurrencyResponse $currencyResponse
     * @return CurrencyResponse
     */
    public function store(CurrencyParam $currencyParam, CurrencyRepository $currencyRepository, CurrencyResponse $currencyResponse): CurrencyResponse;
    
    /**
     * @param CurrencyParam $currencyParam
     * @param CurrencyRepository $currencyRepository
     * @param CurrencyResponse $currencyResponse
     * @return CurrencyResponse
     */
    public function update(CurrencyParam $currencyParam, CurrencyRepository $currencyRepository, CurrencyResponse $currencyResponse): CurrencyResponse;
    
    /**
     * @param string $code
     * @param CurrencyRepository $currencyRepository
     * @param CurrencyResponse $currencyResponse
     * @return CurrencyResponse
     */
    public function getByCode(string $code, CurrencyRepository $currencyRepository, CurrencyResponse $currencyResponse): CurrencyResponse;
    
    /**
     * @param string $q
     * @param CurrencyRepository $currencyRepository
     * @param CurrencySearchResponse $currencySearchResponse
     * @param int $paging
     * @return CurrencySearchResponse
     */
    public function getLike(string $q, CurrencyRepository $currencyRepository, CurrencySearchResponse $currencySearchResponse, int $paging = 12): CurrencySearchResponse;
}