<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-13
 * Time: 19:16
 */

namespace WebAppId\Country\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use WebAppId\Country\Repositories\CountryRepository;
use WebAppId\Country\Services\Params\AddCountryParam;

class CountryTableSeeder extends Seeder
{
    public function run(CsvToArray $csvToArray,
                        CountryRepository $countryRepository,
                        AddCountryParam $addCountryParam)
    {
        $file = __DIR__ . '/../Resources/Csv/country.csv';
        $header = array('id', 'code', 'name', 'continent', 'wikipedia_link', 'keywords');
        $datas = $csvToArray->convert($file, $header);
        DB::beginTransaction();
        foreach ($datas as $data) {
            if ($data['id'] != 'id') {
                $addCountryParam->setId($data['id']);
                $addCountryParam->setCode($data['code']);
                $addCountryParam->setName($data['name']);
                $addCountryParam->setWikipediaLink($data['wikipedia_link']);
                $addCountryParam->setKeywords($data['keywords']);
                $result = $this->container->call([$countryRepository, 'getCountryByCode'], ['code' => $data['code']]);
                if ($result == null) {
                    $this->container->call([$countryRepository, 'addCountry'], ['addCountryParam' => $addCountryParam]);
                } else {
                    $this->container->call([$countryRepository, 'updateCountryByCode'], ['addCountryParam' => $addCountryParam, 'code' => $addCountryParam->getCode()]);
                }
            }
        }
        DB::commit();
        
    }
}