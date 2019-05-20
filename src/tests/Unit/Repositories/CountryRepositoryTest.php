<?php

namespace WebAppId\Country\Tests\Unit\Repositories;

use WebAppId\Country\Repositories\CountryRepository;
use WebAppId\Country\Services\Params\CountryParam;
use WebAppId\Country\Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-12
 * Time: 14:49
 */
class CountryRepositoryTest extends TestCase
{
    private $countryRepository;
    
    private function countryRepository(): CountryRepository
    {
        if ($this->countryRepository == null) {
            $this->countryRepository = $this->getContainer()->make(CountryRepository::class);
        }
        return $this->countryRepository;
    }
    
    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }
    
    public function createDummy(int $id): ?CountryParam
    {
        $addCountryParam = new CountryParam();
        $addCountryParam->setCode($this->getFaker()->uuid);
        $addCountryParam->setId($id);
        $addCountryParam->setName($this->getFaker()->text(80));
        $addCountryParam->setCurrencyId($this->getFaker()->randomNumber());
        $addCountryParam->setKeywords($this->getFaker()->text(40));
        $addCountryParam->setContinent($this->getFaker()->text(50));
        $addCountryParam->setWikipediaLink($this->getFaker()->url);
        return $addCountryParam;
    }
    
    private function createData(CountryParam $dummy)
    {
        return $this->getContainer()->call([$this->countryRepository(), 'store'], ['countryParam' => $dummy]);
    }
    
    public function testAddCountry(): void
    {
        $dummy = $this->createDummy($this->getFaker()->randomNumber());
        $result = $this->createData($dummy);
        self::assertNotEquals(null, $result);
        self::assertEquals($dummy->getId(), $result->id);
        self::assertEquals($dummy->getCode(), $result->code);
        self::assertEquals($dummy->getName(), $result->name);
        self::assertEquals($dummy->getCurrencyId(), $result->currency_id);
        self::assertEquals($dummy->getKeywords(), $result->keywords);
        self::assertEquals($dummy->getWikipediaLink(), $result->wikipedia_link);
        self::assertEquals($dummy->getContinent(), $result->continent);
    }
    
    public function testGetCountryLike(): void
    {
        $random = $this->getFaker()->numberBetween(20, 50);
        for ($i = 0; $i < $random; $i++) {
            $dummy[$i] = $this->createDummy($i);
            $result[$i] = $this->createData($dummy[$i]);
        }
        
        $search = ['a', 'i', 'u', 'e', 'o'];
        
        $randomNumber = $this->getFaker()->numberBetween(0, count($search) - 1);
        
        $result = $this->getContainer()->call([$this->countryRepository(), 'getLike'], ['search' => $search[$randomNumber]]);
        self::assertGreaterThanOrEqual(12, count($result));
    }
    
    public function testGetCountryByCode(): void
    {
        $dummy = $this->createDummy($this->getFaker()->randomNumber());
        $this->createData($dummy);
        $resultSearch = $this->getContainer()->call([$this->countryRepository(), 'getByCode'], ['code' => $dummy->getCode()]);
        self::assertNotEquals(null, $resultSearch);
        self::assertEquals($dummy->getId(), $resultSearch->id);
        self::assertEquals($dummy->getCode(), $resultSearch->code);
        self::assertEquals($dummy->getName(), $resultSearch->name);
        self::assertEquals($dummy->getKeywords(), $resultSearch->keywords);
        self::assertEquals($dummy->getWikipediaLink(), $resultSearch->wikipedia_link);
        self::assertEquals($dummy->getContinent(), $resultSearch->continent);
    }
    
    public function testUpdateCountryByCode(): void
    {
        $dummy = $this->createDummy($this->getFaker()->randomNumber());
        $this->createData($dummy);
        $newData = $this->createDummy($this->getFaker()->randomNumber());
        $newData->setCode($dummy->getCode());
        $updateResult = $this->getContainer()->call([$this->countryRepository(), 'updateByCode'], ['code' => $dummy->getCode(), 'countryParam' => $newData]);
        self::assertNotEquals(null, $updateResult);
    }
}