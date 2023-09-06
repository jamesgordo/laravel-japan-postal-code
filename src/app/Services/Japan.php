<?php

namespace JamesGordo\JapanPostalCode\Services;

use Exception;
use GuzzleHttp\Client;
use JamesGordo\CSV\Parser;

class Japan
{
    public function prefectures(): array
    {
        $csv = __DIR__ . '/../../database/seeders/csvs/prefectures.csv';
        $items = new Parser($csv);
        return $items->all();
    }

    public function cities(): array
    {
        $csv = __DIR__ . '/../../database/seeders/csvs/cities.csv';
        $items = new Parser($csv);
        return $items->all();
    }

    public function postalCode(string $postal_code): array
    {
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $response = $client->request('GET', "https://zipcloud.ibsnet.co.jp/api/search?zipcode=$postal_code");
        $data = json_decode((string) $response->getBody());
        if (!is_array($data->results) || count($data->results) < 1) {
            throw new Exception('Address not found.');
        }

        $result = $data->results[0];

        return [
            'postal_code' => $result->zipcode,
            'prefecture' => $result->address1,
            'city' => $result->address2,
            'address' => $result->address3,
        ];
    }
}
