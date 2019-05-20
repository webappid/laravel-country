<?php
/**
 * Author: galih
 * Date: 2019-05-19
 * Time: 21:26
 */

namespace WebAppId\Country\Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use WebAppId\Country\Repositories\CurrencyRepository;
use WebAppId\Country\Services\Params\CurrencyParam;

class CurrencyTableSeeder extends Seeder
{
    public function run(CurrencyRepository $currencyRepository,
                        CurrencyParam $currencyParam)
    {
        $filename = __DIR__ . '/../Resources/Csv/currency.csv';
        $header = array('id', 'code', 'name');
        
        $delimiter = ',';
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }
        
        if (($handle = fopen($filename, 'r')) !== false) {
            DB::beginTransaction();
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                $data = array_combine($header, $row);
                if ($data['id'] != 'id') {
                    $currencyParam->setId($data['id']);
                    $currencyParam->setCode($data['code']);
                    $currencyParam->setName($data['name']);
                    $result = $this->container->call([$currencyRepository, 'getByCode'], ['code' => $data['code']]);
                    if ($result == null) {
                        $this->container->call([$currencyRepository, 'store'], ['currencyParam' => $currencyParam]);
                    } else {
                        $this->container->call([$currencyRepository, 'update'], ['currencyParam' => $currencyParam]);
                    }
                }
                
            }
            DB::commit();
            fclose($handle);
        }
    }
}