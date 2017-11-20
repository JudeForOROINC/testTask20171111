<?php

namespace Tests\Feature\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use App\Client;
use App\User;

class ClientTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testsClientsAreCreatedCorrectly()
    {
        $user    = factory(User::class)->create();
        $token   = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $client = factory(\App\Client::class)->make([
            'personal_code' => 'Mama mila ramu!',
        ]);

        $responce = $this->json('POST', '/api/clients', $client->toArray(), $headers);
        $responce->assertStatus(201)
            ->assertJson([
                [
                    'clientinsert' => 51,
                ],
            ]);
        $this->assertDatabaseHas('clients_view', ['id' => 51]);
    }

    public function testsClientsAreUpdatedCorrectly()
    {
        $user    = factory(User::class)->create();
        $token   = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $client = factory(\App\Client::class)->create([
            'personal_code' => 'Mama mila ramu!',

        ]);

        $payload = factory(\App\Client::class)->make(
            [
                'personal_code' => 'Mama_mila_ramu',
            ])->toArray();

        $response = $this->json('PUT', '/api/clients/' . $client->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([
                [
                    'clientedit' => 51,
                ],
            ]);
        $this->assertDatabaseHas('clients_view', [
            'id'            => 51,
            'personal_code' => 'Mama_mila_ramu',
        ]);
    }

    public function testsClientsAreDeletedCorrectly()
    {
        $user    = factory(User::class)->create();
        $token   = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $article = factory(\App\Client::class)->create([
            'personal_code' => 'Mama mila ramu!',

        ]);

        $this->json('DELETE', '/api/clients/' . $article->id, [], $headers)
            ->assertStatus(204);
    }

    public function testClientsAreListedCorrectly()
    {
        $user    = factory(User::class)->create();
        $token   = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $client = factory(\App\Client::class)->create([
            'personal_code' => 'Mama mila ramu! first',
            'email'         => 'secret@mail.com',

        ]);
        $client = factory(\App\Client::class)->create([
            'personal_code' => 'Mama mila ramu! second',
            'email'         => 'secrets@mail.com',

        ]);


        $response = $this->json('GET', '/api/clients', [], $headers);
        $response
            ->assertJsonFragment(
                [
                    'personal_code' => 'Mama mila ramu! first',
                    'email'         => 'secret@mail.com',
                ]);

        $response->assertJsonFragment(
            [
                'personal_code' => 'Mama mila ramu! second',
                'email'         => 'secrets@mail.com',
            ])
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'lastname_id',
                    'lastname_id',
                    'firstname_id',
                    'personal_code',
                    'email',
                    'city_id',
                    'country_id',
                ],
            ]);
    }


    public function testsGetClientsSuccessfully()
    {
        $payload = [
            'name'                  => 'TestName',
            'email'                 => 'test@gmail.com',
            'password'              => 'test123',
            'password_confirmation' => 'test123',
            //'personal_code' => 'Mama mila ramu!'
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);;
    }

    public function testsRequiresPasswordEmailAndName()
    {
        $this->json('post', '/api/register')
            ->assertStatus(422)
            ->assertJsonFragment([
                'name'     => ['The name field is required.'],
                'email'    => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);
    }

    public function testsRequirePasswordConfirmation()
    {
        $payload = [
            'name'     => 'John',
            'email'    => 'john@toptal.com',
            'password' => 'toptal123',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(422)
            ->assertJsonFragment([
                'password' => ['The password confirmation does not match.'],
            ]);
    }

    public function testsLoginSucsess()
    {
//[{"data":{"api_token":"xtiuolswvo7aY64Rqd5cbKrDAGz0lO7QR4GDmXowZlHrKkuecnM9ZztRgEPx","created_at":"2017-11-20 18:19:08","email":"admin@test.com","id":1,"name":"Administrator","updated_at":"2017-11-20 18:19:08"}}].

        $payload = [
            
            'email'    => 'admin@test.com',
            'password' => 'toptal',
        ];
        $this->json('post', '/api/login', $payload )
            ->assertStatus(200)
            ->assertJsonFragment([
                'name'     => 'Administrator',
                'email'    => 'admin@test.com',
                
            ])
            ->assertJsonStructure([
	        'data' => 	[
		    'api_token',
		    'created_at',
		    'email',
		    'id',
		    'name',
		    'updated_at',
		]
]);
    }
  
    public function testsLoginRequiresPassAndName()
    {
//[{"errors":{"email":["The email field is required."],"password":["The password field is required."]},"message":"The given data was invalid."}].

        $this->json('post', '/api/login')
            ->assertStatus(422)
            ->assertJsonFragment([
 
                'email'    => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);
    }


}
