<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /**
     * @test
     * Test login
     */
    public function test_login_user()
    {
        //Create user
        //attempt login
        $response = $this->json('POST', route('api.v1.login'), [
            'email' => 'superadmin@demo.dev',
            'password' => '123456',
        ]);
        //Assert it was successful and a token was received
        $response->assertStatus(200);
        $result = $response->json();
        $this->assertArrayHasKey('token', ['token' => $result['data']['access_token']]);
    }

    public function test_login_invalid_credentals()
    {
        $response = $this->json('POST', route('api.v1.login'), [
            'email' => 'superadmin@demo.dev',
            'password' => '1234564',
        ]);
        $response->assertStatus(400);
    }

    public function test_login_validation()
    {
        $response = $this->json('POST', route('api.v1.login'), []);
        $response->assertStatus(422);
    }

    public function test_get_list_user()
    {
        $user = $this->json('POST', route('api.v1.login'), [
            'email' => 'superadmin@demo.dev',
            'password' => '123456',
        ]);
        $token = $user->json()['data']['access_token'];
        $response = $this->json('GET', route('api.v1.user.list'), [], [
            'Authorization' => 'Bearer '.$token
        ]);
        $this->assertAuthenticated();
        $response->assertSuccessful();
    }

    public function test_get_list_user_has_pagination()
    {
        $user = $this->json('POST', route('api.v1.login'), [
            'email' => 'superadmin@demo.dev',
            'password' => '123456',
        ]);
        $token = $user->json()['data']['access_token'];
        $response = $this->json('GET', route('api.v1.user.list'), [
            'limit' => 10,
            "pagination" => "true",
        ], [
            'Authorization' => 'Bearer '.$token
        ]);
        $this->assertAuthenticated();
        $response->assertSuccessful();
    }

}
