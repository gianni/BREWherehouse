<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Proxy
{
    private $config;

    public function __construct(?array $config = null)
    {
        $this->config = $config ?? config('proxy');
    }

    protected function call(string $url, array $parameters = []): array
    {
        try {
            return Http::get($url, $parameters)->json();
        } catch (Exception $exception) {
            Log::error("Proxy error trying to call $url", ['exception' => $exception]);

            return [
                'error' => $exception->getMessage(),
            ];
        }
    }

    public function getBeer(int $id)
    {
        $url = "{$this->config['endpoint']}/beers/{$id}";

        return $this->call($url);
    }

    public function getBeers(?int $page = 1, ?int $perPage = 25)
    {
        $url = "{$this->config['endpoint']}/beers";

        return $this->call($url, [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }
}
