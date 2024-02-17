<?php

namespace App\Http\Controllers;

use App\Http\Requests\BeerListRequest;
use App\Interfaces\BeerRepositoryInterface;
use Illuminate\Http\JsonResponse;

class BeerController extends Controller
{
    private BeerRepositoryInterface $beerRepository;

    public function __construct(BeerRepositoryInterface $beerRepository)
    {
        $this->beerRepository = $beerRepository;
    }

    public function index(BeerListRequest $request): JsonResponse
    {

        $page = $request->query('page');
        $perPage = $request->query('per_page');

        return response()->json(
            $this->beerRepository->getBeers(
                $page,
                $perPage
            )
        );
    }

    public function show(int $id)
    {
        return response()->json(
            $this->beerRepository->getBeer($id)
        );
    }
}
