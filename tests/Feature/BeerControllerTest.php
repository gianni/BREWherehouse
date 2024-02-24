<?php

use App\Models\User;
use Illuminate\Support\Facades\Http;

describe('Beers Controller', function () {

    test('user authenticated can list properly the beers list', function () {

        Http::fake([
            '*' => Http::response([
                [],
                [],
                [],
            ]),
        ]);

        $user = User::factory()->create();

        $jsonResponse = asAuthenticated($user)
            ->getJson('/api/beers?page=1&per_page=3')
            ->assertStatus(200);

        expect($jsonResponse->json())->toHaveCount(3);
    });

    test('user not authenticated cannot list properly the beers list', function () {

        $this->getJson('/api/beers?page=1&per_page=3')
            ->assertStatus(401);

    });

    test('when user is authenticated can get beer details', function () {

        $portionBeerDetails = [
            'id' => 1,
            'name' => 'Buzz',
            'tagline' => 'A Real Bitter Experience.',
            'first_brewed' => '09/2007',
        ];

        Http::fake([
            '*' => Http::response($portionBeerDetails),
        ]);

        $user = User::factory()->create();

        $jsonResponse = asAuthenticated($user)
            ->getJson('/api/beers/1')
            ->assertJson($portionBeerDetails)
            ->assertStatus(200);
    });
});

