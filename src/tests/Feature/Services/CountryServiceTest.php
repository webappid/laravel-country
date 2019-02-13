<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-13
 * Time: 13:03
 */

namespace WebAppId\Country\Tests\Feature\Services;

use WebAppId\Country\Services\CountryService;
use WebAppId\Country\Tests\TestCase;
use WebAppId\Country\Tests\Unit\Repositories\CountryRepositoryTest;

class CountryServiceTest extends TestCase
{
    
    private $countryService;
    private $countryRepositoryTest;
    
    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }
    
    private function countryService(): CountryService
    {
        if ($this->countryService == null) {
            $this->countryService = $this->getContainer()->make(CountryService::class);
        }
        
        return $this->countryService;
    }
    
    private function countryRepositoryTest(): CountryRepositoryTest
    {
        if ($this->countryRepositoryTest == null) {
            $this->countryRepositoryTest = $this->getContainer()->make(CountryRepositoryTest::class);
        }
        return $this->countryRepositoryTest;
    }
    
    private function createBulkCountry(): array
    {
        $randomNumber = $this->getFaker()->numberBetween(20, 50);
        
        $data = [];
        for ($i = 0; $i < $randomNumber; $i++) {
            $data[] = $this->testAddCountry();
        }
        
        return $data;
    }
    
    public function testAddCountry()
    {
        $dummy = $this->countryRepositoryTest()->createDummy($this->getFaker()->numberBetween(1, 500000));
        $result = $this->getContainer()->call([$this->countryService(), 'addCountry'], ['addCountryParam' => $dummy]);
        self::assertNotEquals(null, $result);
        self::assertEquals($dummy->getId(), $result->id);
        self::assertEquals($dummy->getCode(), $result->code);
        self::assertEquals($dummy->getName(), $result->name);
        self::assertEquals($dummy->getContinent(), $result->continent);
        self::assertEquals($dummy->getWikipediaLink(), $result->wikipedia_link);
        self::assertEquals($dummy->getKeywords(), $result->keywords);
        return $result;
    }
    
    public function testSearchCountryByCode(): void
    {
        $bulkData = $this->createBulkCountry();
        
        $randomNumber = $this->getFaker()->numberBetween(0, count($bulkData) - 1);
        $resultSearch = $this->getContainer()->call([$this->countryService(), 'getCountryByCode'], ['code' => $bulkData[$randomNumber]['code']]);
        self::assertNotEquals(null, $resultSearch);
    }
    
    public function testSearch(): void
    {
        $bulkData = $this->createBulkCountry();
        
        $searchKey = ['a', 'i', 'u', 'e', 'o'];
        
        $randomKey = $this->getFaker()->numberBetween(0, count($searchKey) - 1);
        
        $searchResult = $this->getContainer()->call([$this->countryService(), 'getCountryLike'], ['q' => $searchKey[$randomKey]]);
        
        self::assertGreaterThan(0, count($searchResult->getCountry()));
        self::assertLessThanOrEqual(12, count($searchResult->getCountry()));
        
        $newRandomKey = $this->getFaker()->numberBetween(0, count($bulkData));
        
        $newSearchResult = $this->getContainer()->call([$this->countryService(), 'getCountryLike'], ['q' => $bulkData[$newRandomKey]['code']]);
        
        self::assertEquals(1, count($newSearchResult->getCountry()));
    }
    
    public function testUpdateCountry(): void
    {
        $result = $this->testAddCountry();
        $newDummy = $this->countryRepositoryTest()->createDummy($this->getFaker()->randomNumber());
        $newDummy->setCode($result->code);
        $resultUpdate = $this->getContainer()->call([$this->countryService(), 'updateCountry'], ['code' => $result->code, 'addCountryParam' => $newDummy]);
        self::assertNotEquals(null, $resultUpdate);
        self::assertEquals($result->id, $resultUpdate->id);
        self::assertEquals($newDummy->getCode(), $resultUpdate->code);
        self::assertEquals($newDummy->getName(), $resultUpdate->name);
        self::assertEquals($newDummy->getContinent(), $resultUpdate->continent);
        self::assertEquals($newDummy->getWikipediaLink(), $resultUpdate->wikipedia_link);
        self::assertEquals($newDummy->getKeywords(), $resultUpdate->keywords);
    }
    
}