<?php

namespace App\Repositories;

use App\Interfaces\BeerRepositoryInterface;
use App\Services\Proxy;

class BeerRepository implements BeerRepositoryInterface
{
    public function getBeers(?int $page = 1, ?int $perPage = 25): array
    {
        $proxy = new Proxy();

        return $proxy->getBeers($page, $perPage);
    }

    public function getBeer(int $id): array
    {
        $proxy = new Proxy();

        return $proxy->getBeer($id);
    }
}
