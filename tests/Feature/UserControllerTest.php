<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

describe('User', function () {

    uses(RefreshDatabase::class);

    test('as authenticated user can call user login api endpoint', function () {

        User::create([
            'name' => 'Mario Rossi',
            'email' => 'mario.rossi@example.com',
            'password' => '12345678',
        ]);

        $this->postJson('/api/user/login', [
            'email' => 'mario.rossi@example.com',
            'password' => '12345678',
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'user',
                'authorization' => [
                    'token',
                    'type',
                ],
            ]);
    });

    test('as authenticated user can retrieve his profile', function () {

        $user = User::factory()->create();

        asAuthenticated($user)
            ->getJson('/api/user/me')
            ->assertStatus(200)
            ->assertJsonStructure(['data' => [
                'id',
                'name',
                'email',
            ]]);

    });

    test('as not authenticated user cannot retrieve his profile', function () {

        $this->getJson('/api/user/me')
            ->assertStatus(401);

    });

});
