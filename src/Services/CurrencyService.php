<?php
/**
 * Author: galih
 * Date: 2019-05-21
 * Time: 04:47
 */

namespace WebAppId\Country\Services;


use WebAppId\Country\Repositories\CurrencyRepository;
use WebAppId\Country\Responses\CurrencyResponse;
use WebAppId\Country\Responses\CurrencySearchResponse;
use WebAppId\Country\Services\Contracts\CurrencyServiceContract;
use WebAppId\Country\Services\Params\CurrencyParam;
use WebAppId\DDD\Services\BaseService;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class CurrencyService
 * @package WebAppId\Country\Services
 */
class CurrencyService extends BaseService implements CurrencyServiceContract
{
    
    /**
     * @param CurrencyParam $currencyParam
     * @param CurrencyRepository $currencyRepository
     * @param CurrencyResponse $currencyResponse
     * @return CurrencyResponse
     */
    public function store(CurrencyParam $currencyParam, CurrencyRepository $currencyRepository, CurrencyResponse $currencyResponse): CurrencyResponse
    {
        $result = $this->getContainer()->call([$currencyRepository, 'store'], ['currencyParam' => $currencyParam]);
        if ($result != null) {
            $currencyResponse->setStatus(true);
            $currencyResponse->setMessage('Store Currency Success');
            $currencyResponse->setCurrency($result);
        } else {
            $currencyResponse->setStatus(false);
            $currencyResponse->setMessage('Store Currency Failed');
        }
        return $currencyResponse;
    }
    
    /**
     * @param CurrencyParam $currencyParam
     * @param CurrencyRepository $currencyRepository
     * @param CurrencyResponse $currencyResponse
     * @return CurrencyResponse
     */
    public function update(CurrencyParam $currencyParam, CurrencyRepository $currencyRepository, CurrencyResponse $currencyResponse): CurrencyResponse
    {
        $result = $this->getContainer()->call([$currencyRepository, 'update'], ['currencyParam' => $currencyParam]);
        if ($result != null) {
            $currencyResponse->setStatus(true);
            $currencyResponse->setMessage('Update currency success');
            $currencyResponse->setCurrency($result);
        } else {
            $currencyResponse->setStatus(false);
            $currencyResponse->setMessage('Update currency failed');
        }
        return $currencyResponse;
    }
    
    /**
     * @param string $code
     * @param CurrencyRepository $currencyRepository
     * @param CurrencyResponse $currencyResponse
     * @return CurrencyResponse
     */
    public function getByCode(string $code, CurrencyRepository $currencyRepository, CurrencyResponse $currencyResponse): CurrencyResponse
    {
        $result = $this->getContainer()->call([$currencyRepository,'getByCode'],['code' => $code]);
        if ($result != null) {
            $currencyResponse->setStatus(true);
            $currencyResponse->setMessage('Data Found');
            $currencyResponse->setCurrency($result);
        } else {
            $currencyResponse->setStatus(false);
            $currencyResponse->setMessage('Data Not Found');
        }
        return $currencyResponse;
    }
    
    /**
     * @param string $q
     * @param CurrencyRepository $currencyRepository
     * @param CurrencySearchResponse $currencySearchResponse
     * @param int $paging
     * @return CurrencySearchResponse
     */
    public function getLike(string $q, CurrencyRepository $currencyRepository, CurrencySearchResponse $currencySearchResponse, int $paging = 12): CurrencySearchResponse
    {
        $results = $this->getContainer()->call([$currencyRepository,'getLike'],['q' => $q]);
        if(count($results)>0){
            $currencySearchResponse->setStatus(true);
            $currencySearchResponse->setMessage('Data found');
            $currencySearchResponse->setCurrency($results);
        }else{
            $currencySearchResponse->setStatus(false);
            $currencySearchResponse->setMessage('Data not found');
        }
        return $currencySearchResponse;
    }
}