<?php
/**
 * Author: galih
 * Date: 2019-05-21
 * Time: 04:48
 */

namespace WebAppId\Country\Tests\Feature\Services;

use WebAppId\Country\Services\CurrencyService;
use WebAppId\Country\Tests\TestCase;
use WebAppId\Country\Tests\Unit\Repositories\CurrencyRepositoryTest;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class CurrencyServiceTest
 * @package Tests\Feature\Services
 */
class CurrencyServiceTest extends TestCase
{
    /**
     * @var CurrencyRepositoryTest
     */
    private $currencyRepositoryTest;
    
    /**
     * @var CurrencyService
     */
    private $currencyService;
    
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->currencyService = $this->getContainer()->make(CurrencyService::class);
        $this->currencyRepositoryTest = $this->getContainer()->make(CurrencyRepositoryTest::class);
        parent::__construct($name, $data, $dataName);
    }
    
    public function testGetByCode()
    {
        $currency = $this->testStore();
        $result = $this->getContainer()->call([$this->currencyService, 'getByCode'], ['code' => $currency->getCurrency()->code]);
        self::assertTrue($result->isStatus());
    }
    
    public function testStore()
    {
        $dummy = $this->getContainer()->call([$this->currencyRepositoryTest, 'dummy']);
        $result = $this->getContainer()->call([$this->currencyService, 'store'], ['currencyParam' => $dummy]);
        self::assertTrue($result->isStatus());
        return $result;
    }
    
    public function testUpdate()
    {
        $currency = $this->testStore();
        $dummy = $this->getContainer()->call([$this->currencyRepositoryTest, 'dummy']);
        $dummy->setCode($currency->getCurrency()->code);
        $result = $this->getContainer()->call([$this->currencyService, 'update'], ['currencyParam' => $dummy]);
        self::assertTrue($result->isStatus());
        
    }
    
    public function testGetLike()
    {
        $searchKey = ['a', 'i', 'u', 'e', 'o'];
        
        $randomKey = $this->getFaker()->numberBetween(0, count($searchKey) - 1);
        
        $result = $this->getContainer()->call([$this->currencyService, 'getLike'], ['q' => $searchKey[$randomKey]]);
        
        self::assertTrue($result->isStatus());
    }
}
