<?php

use App\Services\Proxy;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Promise\RejectedPromise;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

describe('Proxy Service', function () {

    test('proxy retrives correctly a list of beers', function () {

        // Http::fake([
        //     config('proxy.endpoint').'/beers' => Http::response(
        //         [

        //         ],
        //         200,
        //         ['Content-Type' => 'application/json']
        //     )
        // ]);

        $proxy = new Proxy();
        $result = $proxy->getBeers();
        expect($result)->toBeArray();
        expect($result)->toHaveCount(25);

    });

    test('proxy retrives correctly the first beer', function () {

        // Http::fake([
        //     config('proxy.endpoint').'/beers' => Http::response(
        //         [

        //         ],
        //         200,
        //         ['Content-Type' => 'application/json']
        //     )
        // ]);

        $proxy = new Proxy();
        $result = $proxy->getBeer(1);
        expect($result)->toBeArray();

    });

    test('when api endpoint is not available proxy logs correctly the error', function () {

        Http::fake([
            config('proxy.endpoint').'/beers' => Http::throw(),
        ]);

        $proxy = new Proxy();
        $result = $proxy->getBeers();

        Log::shouldReceive('info')->with('Proxy error trying to call '.config('proxy.endpoint').'/beers' );
        expect($result)->toBeArray();

    });



});
