<?php

namespace Tests\Feature\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use App\Client;

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
        $user = factory(\App\Client::class)->make([
'personal_code'=>'Mama mila ramu!'
]);
	//var_dump($user);die;
//        $token = $user->generateToken();
//        $headers = ['Authorization' => "Bearer $token"];
        $headers = [];
//var_dump($user->toArray()); die;
        ;

        $responce = $this->json('POST', '/api/clients', $user->toArray(), $headers);
//var_dump($responce->message); die;
//var_dump($responce->content());die;
            $responce->assertStatus(200)
//;
            ->assertJson(['personal_code' => 'Mama mila ramu!']);
    }

    public function testsClientsAreUpdatedCorrectly()
    {
        //$user = factory(User::class)->create();
        //$token = $user->generateToken();
        //$headers = ['Authorization' => "Bearer $token"];
    $headers = [];
   $article = factory(\App\Client::class)->create([
            'personal_code' => 'Mama mila ramu!',
            
        ]);

        $payload = factory(\App\Client::class)->make(
[
'personal_code' => 'Mama_mila_ramu'
])->toArray();

        $response = $this->json('PUT', '/api/clients/' . $article->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([ 
                'personal_code' => 'Mama_mila_ramu', 
        ]);
    }

    public function testsClientsAreDeletedCorrectly()
    {
        // $user = factory(User::class)->create();
        // $token = $user->generateToken();
        // $headers = ['Authorization' => "Bearer $token"];
        $headers = [];
   $article = factory(\App\Client::class)->create([
            'personal_code' => 'Mama mila ramu!',
            
        ]);

        $this->json('DELETE', '/api/clients/' . $article->id, [], $headers)
            ->assertStatus(204);
    }

    public function testClientsAreListedCorrectly()
    {
   $article = factory(\App\Client::class)->create([
            'personal_code' => 'Mama mila ramu! first',
            
        ]);

   $article = factory(\App\Client::class)->create([
            'personal_code' => 'Mama mila ramu! second',
            
        ]);

//        $user = factory(User::class)->create();
  //      $token = $user->generateToken();
//        $headers = ['Authorization' => "Bearer $token"];
        $headers = [];

        $response = $this->json('GET', '/api/clients', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [ 'personal_code' => 'Mama mila ramu! first' ],
                [ 'personal_code' => 'Mama mila ramu! second' ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'body', 'title', 'created_at', 'updated_at'],
            ]);
    }


    public function testsGetClientsSuccessfully()
    {
        $payload = [
//            'name' => 'John',
  //          'email' => 'john@toptal.com',
   //         'password' => 'toptal123',
    //        'password_confirmation' => 'toptal123',
	      'personal_code' => 'Mama mila ramu!'	
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
            ->assertJson([
                'name' => ['The name field is required.'],
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);
    }

    public function testsRequirePasswordConfirmation()
    {
        $payload = [
            'name' => 'John',
            'email' => 'john@toptal.com',
            'password' => 'toptal123',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                'password' => ['The password confirmation does not match.'],
            ]);
    }

    
}
