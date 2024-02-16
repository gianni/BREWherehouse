<?php

namespace App\Http\Controllers;

use App\Interfaces\BeerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProxyController extends Controller
{
    private BeerRepositoryInterface $beerRepository;

    public function __construct(BeerRepositoryInterface $beerRepository)
    {
        $this->beerRepository = $beerRepository;
    }

    public function index(Request $request): JsonResponse
    {

        // todo: add validation page/per_page

        return response()->json(
            $this->beerRepository->getBeers(
                $request->query('page'),
                $request->query('per_page')
            )
        );
    }

    public function show(string $id)
    {
        return response()->json(
            $this->beerRepository->getBeer($id)
        );
    }
}
