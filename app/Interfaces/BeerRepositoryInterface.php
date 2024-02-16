<?php

namespace App\Interfaces;

interface BeerRepositoryInterface
{
    public function getBeers(?int $page, ?int $perPage): array;

    public function getBeer(int $id): array;
}
