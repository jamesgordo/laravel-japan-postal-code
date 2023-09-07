<?php

use JamesGordo\JapanPostalCode\Services\Japan;

it('should return all Prefectures in Japan', function () {
    $prefectures = (new Japan())->prefectures();
    expect($prefectures)->toBeArray();

    foreach ($prefectures as $prefecture) {
        expect($prefecture)->toHaveProperties([
            'id',
            'prefecture_id',
            'prefecture_en',
            'prefecture_ja',
        ]);
    }
});

it('should return all Cities in Japan', function () {
    $cities = (new Japan())->cities();
    expect($cities)->toBeArray();

    foreach ($cities as $city) {
        expect($city)->toHaveProperties([
            'id',
            'prefecture_id',
            'city_en',
            'city_ja',
            'special_district_ja',
        ]);
    }
});

it('should return the complete address of the Postal Code.', function () {
    $postal_code = 7830060;
    $location = (new Japan())->postalCode($postal_code);
    expect((int) $location['postal_code'])->toBe($postal_code);
    expect((object) $location)->toMatchArray([
        'postal_code' => '7830060',
        'prefecture' => '高知県',
        'city' => '南国市',
        'address' => '蛍が丘',
    ]);
});
