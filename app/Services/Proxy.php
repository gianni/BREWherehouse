<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Proxy
{
    private $config;

    public function __construct(?array $config = null)
    {
        $this->config = $config ?? config('proxy');
    }

    protected function callApi(string $url, array $data = []): array
    {
        try {
            return Http::get($url, $data)->json();
        } catch (Exception $exception) {
            Log::error("Proxy error trying to call $url", ['exception' => $exception]);

            return [
                'error' => $exception->getMessage()
            ];
        }
    }

    public function getBeer(int $id)
    {
        $url = "{$this->config['endpoint']}/beer/{$id}";

        return $this->callApi($url);
    }

    public function getBeers()
    {
        $url = "{$this->config['endpoint']}/beers";

        return $this->callApi($url);
    }
}
