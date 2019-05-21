<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-13
 * Time: 13:03
 */

namespace WebAppId\Country\Tests\Feature\Services;

use WebAppId\Country\Models\Country;
use WebAppId\Country\Responses\CountryResponse;
use WebAppId\Country\Services\CountryService;
use WebAppId\Country\Tests\TestCase;
use WebAppId\Country\Tests\Unit\Repositories\CountryRepositoryTest;

class CountryServiceTest extends TestCase
{
    /**
     * @var CountryService
     */
    private $countryService;
    /**
     * @var CountryServiceTest
     */
    private $countryRepositoryTest;
    
    /**
     * @return CountryService
     */
    private function countryService(): CountryService
    {
        if ($this->countryService == null) {
            $this->countryService = $this->getContainer()->make(CountryService::class);
        }
        
        return $this->countryService;
    }
    
    /**
     * @return CountryRepositoryTest
     */
    private function countryRepositoryTest(): CountryRepositoryTest
    {
        if ($this->countryRepositoryTest == null) {
            $this->countryRepositoryTest = $this->getContainer()->make(CountryRepositoryTest::class);
        }
        return $this->countryRepositoryTest;
    }
    
    /**
     * @return array
     */
    private function createBulkCountry(): array
    {
        $randomNumber = $this->getFaker()->numberBetween(20, 50);
        
        $data = [];
        for ($i = 0; $i < $randomNumber; $i++) {
            $data[] = $this->testAddCountry();
        }
        
        return $data;
    }
    
    /**
     * @return Country|null
     */
    public function testAddCountry(): ?CountryResponse
    {
        $dummy = $this->countryRepositoryTest()->createDummy($this->getFaker()->numberBetween(1, 500000));
        $result = $this->getContainer()->call([$this->countryService(), 'store'], ['countryParam' => $dummy]);
        
        self::assertTrue($result->isStatus());
        
        self::assertNotEquals(null, $result);
        self::assertEquals($dummy->getId(), $result->getCountry()->id);
        self::assertEquals($dummy->getCode(), $result->getCountry()->code);
        self::assertEquals($dummy->getName(), $result->getCountry()->name);
        self::assertEquals($dummy->getContinent(), $result->getCountry()->continent);
        self::assertEquals($dummy->getWikipediaLink(), $result->getCountry()->wikipedia_link);
        self::assertEquals($dummy->getKeywords(), $result->getCountry()->keywords);
        return $result;
    }
    
    /**
     * @return void
     */
    public function testSearchCountryByCode(): void
    {
        $bulkData = $this->createBulkCountry();
        
        $randomNumber = $this->getFaker()->numberBetween(0, count($bulkData) - 1);
        $resultSearch = $this->getContainer()->call([$this->countryService(), 'getByCode'], ['code' => $bulkData[$randomNumber]->getCountry()->code]);
        self::assertNotEquals(null, $resultSearch);
    }
    
    /**
     * @return void
     */
    public function testSearch(): void
    {
        $bulkData = $this->createBulkCountry();
        
        $searchKey = ['a', 'i', 'u', 'e', 'o'];
        
        $randomKey = $this->getFaker()->numberBetween(0, count($searchKey) - 1);
        
        $searchResult = $this->getContainer()->call([$this->countryService(), 'getLike'], ['q' => $searchKey[$randomKey]]);
        
        self::assertGreaterThan(0, count($searchResult->getCountry()));
        self::assertLessThanOrEqual(12, count($searchResult->getCountry()));
        
        $newRandomKey = $this->getFaker()->numberBetween(0, count($bulkData));
        
        $newSearchResult = $this->getContainer()->call([$this->countryService(), 'getLike'], ['q' => $bulkData[$newRandomKey]->getCountry()->code]);
        
        self::assertEquals(1, count($newSearchResult->getCountry()));
    }
    
    /**
     * @return void
     */
    public function testUpdateCountry(): void
    {
        $result = $this->testAddCountry();
        $newDummy = $this->countryRepositoryTest()->createDummy($this->getFaker()->randomNumber());
        $newDummy->setCode($result->getCountry()->code);
       
        $resultUpdate = $this->getContainer()->call([$this->countryService(), 'updateCountry'], ['code' => $result->getCountry()->code, 'countryParam' => $newDummy]);
        self::assertTrue($resultUpdate->isStatus());
        self::assertEquals($result->getCountry()->id, $resultUpdate->getCountry()->id);
        self::assertEquals($newDummy->getCode(), $resultUpdate->getCountry()->code);
        self::assertEquals($newDummy->getName(), $resultUpdate->getCountry()->name);
        self::assertEquals($newDummy->getContinent(), $resultUpdate->getCountry()->continent);
        self::assertEquals($newDummy->getWikipediaLink(), $resultUpdate->getCountry()->wikipedia_link);
        self::assertEquals($newDummy->getKeywords(), $resultUpdate->getCountry()->keywords);
    }
    
}