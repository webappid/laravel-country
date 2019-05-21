<?php
/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 21:03
 */

namespace WebAppId\Country\Tests\Unit\Repositories;

use WebAppId\Country\Repositories\CurrencyRepository;
use WebAppId\Country\Services\Params\CurrencyParam;
use WebAppId\Country\Tests\TestCase;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com> https://dyangalih.com
 * Class CurrencyRepositoryTest
 * @package Tests\Unit\Repositories
 */
class CurrencyRepositoryTest extends TestCase
{
    
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->currencyRepository = $this->getContainer()->make(CurrencyRepository::class);
        parent::__construct($name, $data, $dataName);
    }
    
    /**
     * @var CurrencyRepository
     */
    private $currencyRepository;
    
    /**
     * @return CurrencyParam
     */
    public function dummy(): CurrencyParam
    {
        $currencyParam = new CurrencyParam();
        $currencyParam->setId($this->getFaker()->numberBetween(10000, 20000));
        $currencyParam->setCode($this->getFaker()->text(5));
        $currencyParam->setName($this->getFaker()->text(50));
        return $currencyParam;
    }
    
    public function testUpdate()
    {
        $currency = $this->testStore();
        $dummy = $this->dummy();
        $dummy->setCode($currency->code);
        $result = $this->getContainer()->call([$this->currencyRepository,'update'],['currencyParam' => $dummy]);
        self::assertNotEquals(null, $result);
        self::assertEquals($dummy->getName(), $result->name);
    }
    
    public function testGetByCode()
    {
        $currency = $this->testStore();
        $result = $this->getContainer()->call([$this->currencyRepository,'getByCode'],['code' => $currency->code]);
        self::assertNotEquals(null, $result);
    }
    
    public function testStore()
    {
        $dummy = $this->dummy();
        $result = $this->getContainer()->call([$this->currencyRepository,'store'],['currencyParam' => $dummy]);
        self::assertNotEquals(null, $result);
        return $result;
    }
    
    public function testGetLike()
    {
        $search = ['a', 'i', 'u', 'e', 'o'];
    
        $randomNumber = $this->getFaker()->numberBetween(0, count($search) - 1);
        
        $resultList = $this->getContainer()->call([$this->currencyRepository,'getLike'],['q' => $search[$randomNumber]]);
        self::assertLessThanOrEqual(12, count($resultList));
    }
}
