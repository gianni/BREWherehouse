<?php

use App\Models\User;
use Illuminate\Support\Facades\Http;

describe('Beers Controller', function () {
    
    test('user authenticated can list properly the beers list', function () {

        Http::fake([
            "*" => Http::response([
                [],
                [],
                []
            ])
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
            "id" => 1,
            "name" => "Buzz",
            "tagline" => "A Real Bitter Experience.",
            "first_brewed" => "09/2007"
        ];

        Http::fake([
            "*" => Http::response($portionBeerDetails)
        ]);

        $user = User::factory()->create();
        
        $jsonResponse = asAuthenticated($user)
            ->getJson('/api/beers/1')
            ->assertJson($portionBeerDetails)
            ->assertStatus(200);
    });
});

    // test('as customer can get properly the detail data', function () {

    //     $user = User::factory()->create();
        
    //     asCustomer($user)
    //         ->getJson('/api/siptrunks/1')
    //         ->assertStatus(200)
    //         ->assertJsonStructure([
    //             'data'=>[
    //                 'id',
    //                 'name',
    //                 'channels',
    //                 'shared'
    //             ]
    //         ]);
    // });

    // test('as customer can create a new sip trunk', function () {

    //     $user = User::factory()->create();
        
    //     asCustomer($user)
    //         ->postJson('/api/siptrunks',[
    //             'name' => 'Sip Trunk name',
    //             'channels' => 2,
    //             'shared'=> false,
    //             'company_id' => 1
    //         ])
    //         ->assertStatus(201)
    //         ->assertJsonPath('data.name', 'Sip Trunk name')
    //         ->assertJsonPath('data.shared', false);

    // });

    // test('as customer cannot create a new sip trunk when the company not exist', function () {

    //     $user = User::factory()->create();
        
    //     asCustomer($user)
    //         ->postJson('/api/siptrunks',[
    //             'name' => 'Sip Trunk name',
    //             'channels' => 2,
    //             'shared'=> false,
    //             'company_id' => 100
    //         ])
    //         ->assertStatus(422)
    //         ->assertJsonPath('message','The selected company id is invalid.')
    //         ->assertJsonStructure([
    //             'message',
    //             'errors' => [
    //                 'company_id'
    //             ]
    //         ]);
            
    // });


    // test('as customer can update a sip trunk correctly', function () {

    //     $user = User::factory()->create();
        
    //     asCustomer($user)
    //         ->putJson('/api/siptrunks/1',[
    //             'name' => 'Sip Trunk name',
    //             'channels' => 2,
    //             'shared'=> false
    //         ])
    //         ->assertStatus(200)
    //         ->assertJsonPath('data.name','Sip Trunk name');
    // });

    // test('as customer when sip trunk has not any numbers associated is possible to delete it', function () {

    //     $user = User::factory()->create();

    //     $jsonResponse = asCustomer($user)
    //         ->postJson('/api/siptrunks',[
    //             'name' => 'Sip Trunk name',
    //             'channels' => 2,
    //             'shared'=> false,
    //             'company_id' => 1
    //         ]);

    //     $jsonResponse->assertStatus(201);
    //     $siptrunk = $jsonResponse->json();
    //     $siptrunkId = $siptrunk['data']['id'];
        
    //     onLandlord();
    //     asCustomer($user)
    //         ->deleteJson("/api/siptrunks/$siptrunkId")
    //         ->assertStatus(200)
    //         ->assertJsonPath('message','Sip Trunk deleted successfully');

    // });

    // test('as customer when sip trunk has a number associated is not possible to delete it', function () {

    //     $user = User::factory()->create();
        
    //     asCustomer($user)
    //         ->deleteJson('/api/siptrunks/1')
    //         ->assertStatus(422)
    //         ->assertJsonPath('message','Cannot delete the sip trunk because it has related numbers');

    // });

    // test('as customer can search a sip trunk using a single search string', function () {

    //     $siptrunkDataToSearch = [
    //         'name' => 'Sip Trunk name',
    //         'channels' => 2,
    //         'shared'=> false
    //     ];

    //     $user = User::factory()->create();

    //     asCustomer($user)
    //     ->postJson('/api/siptrunks', ['company_id' => 1, ...$siptrunkDataToSearch])
    //     ->assertStatus(201);
        
    //     onLandlord();
    //     $jsonResponse = asCustomer($user)
    //         ->getJson('/api/siptrunks?company_id=1&search=Trunk')
    //         ->assertStatus(200)
    //         ->assertJson([
    //             'data' => [
    //                 $siptrunkDataToSearch
    //             ]
    //         ]);

    //     expect($jsonResponse->json()['data'])->toHaveCount(1);

    // });

    // test('as customer can load a siptrunk info and relative company data', function () {

    //     $user = User::factory()->create();

    //     asCustomer($user)
    //         ->getJson('/api/siptrunks/1/details')
    //         ->assertStatus(200)
    //         ->assertJsonStructure([
    //             'data'=>[
    //                 'id',
    //                 'name',
    //                 'channels',
    //                 'shared',
    //                 'company'=>[
    //                     'name'
    //                 ]
    //             ]
    //         ]);

    // });
