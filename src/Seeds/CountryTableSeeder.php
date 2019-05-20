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
use WebAppId\Country\Services\Params\CountryParam;

class CountryTableSeeder extends Seeder
{
    public function run(CsvToArray $csvToArray,
                        CountryRepository $countryRepository,
                        CountryParam $addCountryParam)
    {
        $file = __DIR__ . '/../Resources/Csv/country.csv';
        $header = array('id', 'code', 'name', 'currency_id', 'continent', 'wikipedia_link', 'keywords', 'created_at','updated_at');
        $datas = $csvToArray->convert($file, $header);
        DB::beginTransaction();
        foreach ($datas as $data) {
            if ($data['id'] != 'id') {
                $addCountryParam->setId($data['id']);
                $addCountryParam->setCode($data['code']);
                $addCountryParam->setName($data['name']);
                $addCountryParam->setCurrencyId((int)$data['currency_id']);
                $addCountryParam->setWikipediaLink($data['wikipedia_link']);
                $addCountryParam->setKeywords($data['keywords']);
                $result = $this->container->call([$countryRepository, 'getByCode'], ['code' => $data['code']]);
                if ($result == null) {
                    $this->container->call([$countryRepository, 'store'], ['countryParam' => $addCountryParam]);
                } else {
                    $this->container->call([$countryRepository, 'updateByCode'], ['countryParam' => $addCountryParam, 'code' => $addCountryParam->getCode()]);
                }
            }
        }
        DB::commit();
        
    }
}