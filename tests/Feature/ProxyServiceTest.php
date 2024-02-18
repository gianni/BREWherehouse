<?php

use App\Services\Proxy;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

describe('Proxy Service', function () {

    test('proxy retrives correctly a list of beers', function () {

        $proxy = new Proxy();
        $result = $proxy->getBeers();
        expect($result)->toBeArray();
        expect($result)->toHaveCount(25);

    });

    test('proxy retrives correctly the requested items', function () {

        $proxy = new Proxy();
        $result = $proxy->getBeers(1, 8);
        expect($result)->toBeArray();
        expect($result)->toHaveCount(8);

    });

    test('proxy retrives correctly the beer with id 1', function () {

        $proxy = new Proxy();
        $result = $proxy->getBeer(1);
        expect($result)->toBeArray();

    });

    test('when api endpoint is not available proxy logs correctly the error', function () {

        Http::fake([
            config('proxy.endpoint').'/beers*' => Http::throw(),
        ]);

        $proxy = new Proxy();
        $result = $proxy->getBeers();

        Log::shouldReceive('info')->with('Proxy error trying to call '.config('proxy.endpoint').'/beers');
        expect($result)->toBeArray();

    });

});
