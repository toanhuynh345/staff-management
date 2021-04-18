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
        $response = $this->json('POST',route('api.v1.login'),[
            'email' => 'superadmin@demo.dev',
            'password' => '123456',
        ]);
        //Assert it was successful and a token was received
        $response->assertStatus(200);
        $result = $response->json();
        $this->assertArrayHasKey('token',[ 'token' => $result['data']['access_token']]);
    }

}
